<script>
export default {
  name: "CalendarInput",
  data() {
    return {
      selectedYear: "",
      selectedMonth: "",
      selectedDay: "",
      selectedTime: "",
      availability: new Set(),
      currentMonth: {},
      currentMonthIndex: "",
      calendar: [],
      firstDayStyles: "",
      error: false
    }
  },

  methods: {
    getCalendar(actualYear) {
      const locale = 'en'
      const intlForMonths = new Intl.DateTimeFormat(locale, { month: 'long' })
      const months = [...Array(12).keys()]

      return months.map((monthIndex) => {
        const monthName = intlForMonths.format(new Date(actualYear, monthIndex))
        const nextMonthIndex = (monthIndex + 1) % 12
        const daysOfMonth = new Date(actualYear, nextMonthIndex, 0).getDate()
        const startsOn = new Date(actualYear, monthIndex, 1).getDay()

        return {
          daysOfMonth,
          monthName,
          startsOn
        }
      })
    },

    setCurrentMonth() {
      this.currentMonth = this.calendar[this.currentMonthIndex]
      this.selectedMonth = this.currentMonthIndex
    },

    updateSelectedDay(dayNum) {
      this.selectedDay = dayNum

      const prevSelectedDay = document.querySelector(".selected-day")
      if (prevSelectedDay) prevSelectedDay.classList.remove("selected-day")


      const selectedDay = document.querySelector("#day-" + dayNum)
      selectedDay.classList.add("selected-day")
    },

    addAvaliableDate() {
      if (!this.selectedDay || !this.selectedTime) {
        this.error = true
        console.error("Hora o día no seleccionado")
        return
      }

      this.error = false

      const newDate = new Date(this.selectedYear, this.selectedMonth, this.selectedDay, this.selectedTime.split(":")[0], this.selectedTime.split(":")[1])

      this.availability.add(newDate.valueOf())
    },

    goPreviousMonth() {
      if (this.currentMonthIndex > 0) {
        this.currentMonthIndex--
        this.setCurrentMonth()
        
        this.selectedDay = ""
        const prevSelectedDay = document.querySelector(".selected-day")
        if (prevSelectedDay) prevSelectedDay.classList.remove("selected-day")
      }
    },

    goNextMonth() {
      if (this.currentMonthIndex < 11) {
        this.currentMonthIndex++
        this.setCurrentMonth()

        this.selectedDay = ""
        const prevSelectedDay = document.querySelector(".selected-day")
        if (prevSelectedDay) prevSelectedDay.classList.remove("selected-day")
      }
    }
  },

  computed: {
    getFirstDayStyles() {
      return `grid-column-start: ${this.currentMonth.startsOn}`
    }
  },

  created() {
    const d = new Date()
    this.currentMonthIndex = d.getMonth()
    this.selectedYear = d.getFullYear()

    this.calendar = this.getCalendar(this.selectedYear)
    this.setCurrentMonth()
  }
}
</script>

<template>
  <article>
      <ol>
        <li class="month-name">
          <span class="prev-month-btn" @click="goPreviousMonth">prev</span>
          {{ currentMonth.monthName }}
          <span class="next-month-btn" @click="goNextMonth">next</span>
        </li>

        <li class="day-name">Mon</li>
        <li class="day-name">Tue</li>
        <li class="day-name">Wed</li>
        <li class="day-name">Thu</li>
        <li class="day-name">Fri</li>
        <li class="day-name">Sat</li>
        <li class="day-name">Sun</li>
  
        <li
          v-for="(day, index) in currentMonth.daysOfMonth"
          :key="index" :class="{ 'first-day': day == 1}"
          :style="day == 1 ? getFirstDayStyles : ''"
          @click="updateSelectedDay(day)"
          :id="'day-' + day"
          class="day-num"
        >
          {{ day }}
        </li>
      </ol>

      <form @submit.prevent="addAvaliableDate">
        <label for="selectedTime">
          <span>Select an hour:</span>
          <input type="time" name="selectedTime" id="selectedTime" v-model="selectedTime">
        </label>

        <button type="submit">Confirm</button>
      </form>

      <template v-if="error">
        <span class="error">Enter a time and date before continuing</span>
      </template>
    </article>
</template>

<style scoped>
article {
  display: flex;
  flex-direction: column;
  gap: .5rem;
}

ol {
  width: 60%;
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  justify-items: center;
  gap: .5rem;
  list-style: none;
}

li {
  text-align: center;
}

.month-name {
  width: 100%;
  grid-column-start: 1;
  grid-column-end: 8;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--color-text-bright);
}

.month-name span {
  font-size: .9rem;
  font-weight: 400;
  color: var(--color-text);
}

.day-name {
  font-weight: 600;
  color: var(--color-text-bright);
}

.day-num {
  width: fit-content;
  padding: .25rem .5rem;
}

.selected-day {
  outline: 1px solid var(--color-border-hover);
  border-radius: 6px;
}

li:not(.day-name):hover {
  cursor: pointer;
}

form {
  display: flex;
  flex-direction: column;
  gap: .5rem;
}

form label {
  display: flex;
  align-items: center;
  gap: .5rem;
}

form button {
  padding: .5rem 1.25rem;
  width: fit-content;
  background-color: rgba(255 255 255 / .1);
  border: 1px solid var(--color-border-hover);
  border-radius: 6px;
  transition: background-color .2s ease-in-out;
}

form button:hover {
  cursor: pointer;
  background-color: var(--color-border-hover);
}

input[type=time] {
  width: 90px;
  padding: .25rem .5rem;
  background: none;
  border: none;
}

input[type=time]::-webkit-datetime-edit-fields-wrapper {
  display: flex;
  justify-content: center;
  gap: .25rem;
}

input[type=time]::-webkit-datetime-edit-text {
  padding: .25rem 0;
}

input[type=time]::-webkit-datetime-edit-hour-field,
input[type=time]::-webkit-datetime-edit-minute-field  {
  padding: .25rem 0;
}

.error {
  width: 60%;
  padding: .5rem 1rem;
  background-color: rgba(200 50 50 / .1);
  border: 1px solid rgba(200 50 50 / .15);
  border-radius: 6px;
  text-align: center;
}
</style>