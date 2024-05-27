<script>
export default {
  name: "CalendarComponent",
  data() {
    return {
      selectedYear: "",
      selectedMonth: "",
      selectedDay: "",
      selectedTime: "",
      availability: [],
      currentMonth: {},
      currentMonthIndex: "",
      calendar: [],
      firstDayStyles: ""
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

      const dayNums = document.querySelectorAll(".day-num")
      dayNums.forEach(day => {
        day.style.outline = "none"
      })


      const selectedDay = document.querySelector("#day-" + dayNum)
      selectedDay.style.outline = "1px solid #09f"
    },

    addAvaliableDate() {
      if (!this.selectedDay || !this.selectedTime) return console.error("Hora o día no seleccionado")

      const newDate = new Date(this.selectedYear, this.selectedMonth, this.selectedDay, this.selectedTime.split(":")[0], this.selectedTime.split(":")[1])

      this.availability.push(newDate.valueOf())
    },

    goPreviousMonth() {
      if (this.currentMonthIndex > 0) {
        this.currentMonthIndex--
        this.setCurrentMonth()
      }
    },

    goNextMonth() {
      if (this.currentMonthIndex < 11) {
        this.currentMonthIndex++
        this.setCurrentMonth()
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
    </article>
</template>

<style scoped>
ol {
  margin-bottom: 1rem;
  width: 60%;
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: .5rem;
  list-style: none;
}

li {
  text-align: center;
}

.month-name {
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

li:not(.day-name, .month-name):focus {
  border: 1px solid white;
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
  width: fit-content;
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
</style>