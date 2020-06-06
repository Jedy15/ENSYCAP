<template>
    <FullCalendar 
        defaultView="dayGridMonth" 
        :plugins="calendarPlugins" 
        :weekends="calendarWeekends"
        :events="calendarEvents"
        :header="{
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        }"
    />
</template>

<script>
import FullCalendar     from '@fullcalendar/vue'
import dayGridPlugin    from '@fullcalendar/daygrid'
import timeGridPlugin   from '@fullcalendar/timegrid'
import interaction      from '@fullcalendar/interaction'
import bootstrapPlugin  from '@fullcalendar/bootstrap'


export default {
components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarPlugins: [ interaction, dayGridPlugin, timeGridPlugin, bootstrapPlugin ],
      calendarWeekends: true,
      calendarEvents: [ // initial event data
        { title: 'Event Now', start: new Date() }
      ]
    }
  }
}
</script>

<style lang='scss'>

@import '~@fullcalendar/core/main.css';
@import '~@fullcalendar/daygrid/main.css';
@import '~@fullcalendar/bootstrap/main.css';

</style>