<template>
  <div>
    <FullCalendar 
        defaultView="dayGridMonth" 
        :plugins="calendarPlugins" 
        :weekends="calendarWeekends"
        :selectable="selectable"
        :events="calendarEvents"
        :locale="locales"
        :weekNumbers= "weekNumbers"
        :header="{
            left: 'dayGridMonth,listMonth today',
            center: 'title',
            right: 'prev,next'
        }"
        @dateClick="handleDateClick"
    />
  </div>
</template>

<script>
import FullCalendar       from '@fullcalendar/vue'
import dayGridPlugin      from '@fullcalendar/daygrid'
import interactionPlugin  from '@fullcalendar/interaction'
import listPlugin         from '@fullcalendar/list'
import esLocale           from '@fullcalendar/core/locales/es';


export default {
components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarPlugins: [ interactionPlugin, dayGridPlugin, listPlugin ],
      locales: esLocale,
      calendarWeekends: true,
      selectable: true,
      weekNumbers: true,
      calendarEvents: [ // initial event data
        { title: 'Event Now', start: new Date() }
      ]
    }
  },
  methods: {
    handleDateClick(info) {
      alert('Clicked on: ' + info.dateStr);
    }
  }
}
</script>

<style lang='scss'>

  @import '~@fullcalendar/core/main.css';
  @import '~@fullcalendar/daygrid/main.css';

</style>