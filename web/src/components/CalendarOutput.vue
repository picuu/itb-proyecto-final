<script>
import { formatTime } from '@/helpers';

export default {
  name: "CalendarInput",
  props: {
    availability: Array
  },
  data() {
    return {
      // availability: [1715065200000,1715670000000,1716274800000,1716879600000,1714665600000,1715270400000,1715875200000,1716480000000,1717084800000,1717493400000,1718098200000,1718703000000,1719307800000,1717666200000,1718271000000,1718875800000,1719480600000],
      loading: true,
      availableDays: [],
      selectedYear: "",
      selectedMonth: "",
      selectedDay: "",
      selectedTime: "Select a day first",
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

        const availableTime = []
        const availableDays = []

        this.availableDays.map(availableDay => {
          if (availableDay.month == monthIndex) {
            availableTime.push(availableDay.time)
            availableDays.push(availableDay.day)
          }
        })

        return {
          daysOfMonth,
          monthName,
          startsOn,
          monthIndex,
          availableDays,
          availableTime
        }
      })
    },

    setCurrentMonth() {
      this.currentMonth = this.calendar[this.currentMonthIndex]
      this.selectedMonth = this.currentMonthIndex
    },

    updateSelectedDay(dayNum) {
      if (!this.currentMonth.availableDays.some(day => day == dayNum)) {
        console.error("día no disponible")
        return
      }

      this.selectedDay = dayNum
      const selectedTimeIndex = this.currentMonth.availableDays.indexOf(dayNum)
      const selectedTime = this.currentMonth.availableTime[selectedTimeIndex]
      this.selectedTime = this.formatTime(selectedTime) + 'h'

      const prevSelectedDay = document.querySelector(".selected-day")
      if (prevSelectedDay) prevSelectedDay.classList.remove("selected-day")


      const selectedDay = document.querySelector("#day-" + dayNum)
      selectedDay.classList.add("selected-day")
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
    },

    getAvailableDays() {
      return this.availability.map(timestamp => {
        const date = new Date(parseInt(timestamp))

        const day = date.getDate()
        const month = date.getMonth()
        const time = `${date.getHours()}:${date.getMinutes()}`

        return { day, month, time }
      })
    },
    
    isAvailable(day) {
      if (this.currentMonth.availableDays.some(d => d == day)) return true
      return false
    },

    formatTime
  },

  computed: {
    getFirstDayStyles() {
      return `grid-column-start: ${this.currentMonth.startsOn}`
    }
  },

  watch: {
    availability(newData, oldData) {
      if (oldData.length >= 1) {
        try {
          this.availableDays = this.getAvailableDays()
          
          const d = new Date()
          this.currentMonthIndex = d.getMonth()
          this.selectedYear = d.getFullYear()
          
          this.calendar = this.getCalendar(this.selectedYear)
          this.setCurrentMonth()
          this.loading = false
        } catch (e) {
          console.log(e)
        } finally {
          this.loading = false
        }
      }
    }
  }
}
</script>

<template>
  <article>
    <template v-if="!loading">
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
          :key="index"
          :class="{ 'first-day': day == 1, 'available': isAvailable(day)}"
          :style="day == 1 ? getFirstDayStyles : ''"
          @click="updateSelectedDay(day)"
          :id="'day-' + day"
          class="day-num"
        >
          {{ day }}
        </li>
      </ol>
    </template>

    <div class="schedule">
      <h4>Schedule</h4>

      <time :datetime="selectedDay + '/' + selectedMonth + '/' + selectedYear + ' ' + selectedTime">
        {{ selectedTime }}
      </time>
    </div>

  </article>
</template>

<style scoped>
article {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

ol {
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

.available {
  font-weight: 500;
  color: rgba(200 200 200);
}

.day-num:not(.available) {
  opacity: .6;
}

.day-num:not(.available):hover {
  cursor: not-allowed;
}

.selected-day {
  outline: 1px solid var(--color-border-hover);
  border-radius: 6px;
}

li:not(.day-name):hover {
  cursor: pointer;
}

.schedule {
  display: flex;
  flex-direction: column;
  gap: .5rem;
}

.schedule h4 {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--color-text-bright);
  text-align: center;
}

time {
  font-size: 1.1rem;
  font-weight: 500;
  text-align: center;
}

.error {
  width: 60%;
  padding: .5rem 1rem;
  background-color: rgba(200 50 50 / .1);
  border: 1px solid rgba(200 50 50 / .15);
  border-radius: 6px;
  text-align: center;
}

@media screen and (width < 341px) {
  ol {
    gap: .25rem;
  }

  .day-num {
    width: fit-content;
    padding: .2rem .35rem;
  }
}
</style>