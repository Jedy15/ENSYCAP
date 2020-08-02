<template>
  <div>
    <FullCalendar 
        defaultView="dayGridMonth" 
        :plugins="calendarPlugins" 
        :weekends="calendarWeekends"
        :selectable="selectable"
        :events="Events"
        :locale="locales"
        :weekNumbers="weekNumbers"
        :header="{
            left: 'dayGridMonth,timeGridWeek,listMonth today',
            center: 'title',
            right: 'prev,next'
        }"
        :eventTextColor="eventTextColor"
        @dateClick="handleDateClick"
        @eventClick="eventClick"
        @select="select"

    />
    <div class="modal" tabindex="-1" role="dialog" id="modal-addEvent">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="!editMode" class="modal-title">Agregar Nuevo Evento</h5>
            <h5 v-else class="modal-title">Editar Evento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="editMode ? updateEvento() : crearEvento()" id="formEvento">
            <div class="modal-body">
              <div class="row">
                <div class="col-auto">
                  <div class="form-group">
                    <label>Fecha</label>
                    <input type="datetime" class="form-control" id="start" disabled
                    v-model="evento.start">
                  </div>
                </div>
                <div class="col-auto"
                  v-if="evento.end">
                  <div class="form-group">
                    <label>Termino</label>
                    <input type="datetime" class="form-control" id="end" disabled
                    v-model="evento.end">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="title">Nombre del evento</label>
                <input v-model="evento.title" type="text" id="title"
                    placeholder="Ingrese Nombre de Evento"
                    class="form-control">
                <h5 class="form-text text-danger"
                  v-if="errors.title"
                  v-html="errors.title"
                ></h5>
              </div>
              <div class="form-group">
                <label for="place">Lugar</label>
                <input v-model="evento.place" type="text" id="place"
                    placeholder="Ingrese Detalles de Lugar"
                    class="form-control">
                <h5 class="form-text text-danger"
                  v-if="errors.place"
                  v-html="errors.place"
                ></h5>
              </div>
              <div class="form-group">
                <label for="description">Descripción</label>
                <textarea v-model="evento.description"
                class="form-control"
                rows="3"></textarea>
              </div>

              <div class="form-group">
                <label class="form-label">Color de Evento</label>
                <div class="row gutters-xs">
                  <div class="col-auto">
                    <label class="colorinput">
                      <input name="color" type="radio" value="rgb(41, 43, 44)" class="colorinput-input"
                      v-model="evento.color">
                      <span class="colorinput-color bg-dark"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="colorinput">
                      <input checked="checked" name="color" type="radio" value="rgb(2, 117, 216)" class="colorinput-input"
                       v-model="evento.color">
                      <span class="colorinput-color bg-primary"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="colorinput">
                      <input type="radio" name="color" value="rgb(104, 97, 206)" class="colorinput-input"
                       v-model="evento.color">
                      <span class="colorinput-color bg-secondary"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="colorinput">
                      <input type="radio" name="color" value="rgb(91, 192, 222)" class="colorinput-input"
                       v-model="evento.color">
                      <span class="colorinput-color bg-info"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="colorinput">
                      <input type="radio" name="color" value="rgb(92, 184, 92)" class="colorinput-input"
                       v-model="evento.color">
                      <span class="colorinput-color bg-success"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="colorinput">
                      <input type="radio" name="color" value="rgb(217, 83, 79)" class="colorinput-input"
                       v-model="evento.color">
                      <span class="colorinput-color bg-danger"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="colorinput">
                      <input type="radio" name="color" value="rgb(240, 173, 78)" class="colorinput-input"
                       v-model="evento.color">
                      <span class="colorinput-color bg-warning"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>


  </div>
</template>

<script>
import FullCalendar       from '@fullcalendar/vue'
import dayGridPlugin      from '@fullcalendar/daygrid'
import interactionPlugin  from '@fullcalendar/interaction'
import listPlugin         from '@fullcalendar/list'
import esLocale           from '@fullcalendar/core/locales/es'
import timeGridPlugin     from '@fullcalendar/timegrid'
import moment             from 'moment';

// import formatDate         from '@fullcalendar/core'


export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  created: function () {
    this.loadEvents();
  },
  data() {
    return {
      calendarPlugins: [ interactionPlugin, dayGridPlugin, listPlugin, timeGridPlugin ],
      locales: esLocale,
      calendarWeekends: true,
      selectable: true,
      weekNumbers: true,
      eventTextColor: 'white',
      Events: '',  // initial event data
      evento: { 
          title : '',
          place: '',
          description: '',
          start: '',
          end: null,
          user_id:  '1',
          CLUES: 'CSSSA005773',
          color: ''

      },
      editMode : false,
      errors:{
        title: null,
        place: null
      }
    }
  },
  methods: {
    loadEvents() {
      axios
        .get("api/events")
        .then( data => (this.Events = data.data))
        .catch(error => console.log(error))
    },

    eventClick(info){
      this.$router.push({ name: 'evento', params: { id: info.event.id } })
    },
    select: function(info) {
      this.limpiarEvento();
      $('#modal-addEvent').modal('show');
      this.editMode = false;
      this.evento.start = moment(info.startStr).format("YYYY-MM-DD HH:mm");
      if (!info.allDay) {
        this.evento.end = moment(info.endStr).format("YYYY-MM-DD HH:mm");
      }      
    },
    handleDateClick(info) {
      this.limpiarEvento();
      $('#modal-addEvent').modal('show');

      if (info.allDay) {
        this.evento.start = moment(info.dateStr).format("YYYY-MM-DD");
      } else {
        this.evento.start = moment(info.dateStr).format("YYYY-MM-DD HH:mm");
      }

      this.editMode = false;
    },

    crearEvento(){
      this.limpiarInputs();
      let url = '/api/events';
      axios.post(url, this.evento)
      .then(response => {
        $('#modal-addEvent').modal('hide');
        swal("Exito", "Evento "+this.evento.title+", ha sido registrado Correctamente", "success");
        this.loadEvents();
        this.limpiarEvento();
      }).catch(e => {          
          // swal("Error","Ocurrio un error al registrar el evento","error");
          let data = e.response.data.errors;
          if(data.title){
              this.errors.title = data.title[0];
              $('#title').addClass('is-invalid');
              $("#title").parent('.input-icon').addClass('is-invalid');
              $("#title").parents('.form-group').addClass('has-error');
          } else {
              $("#title").parents('.form-group').addClass('has-success');
          }

          if(data.place){
              this.errors.place = data.place[0];
              $('#place').addClass('is-invalid');
              // $('#errorTitle').html(data.title[0]);
              $("#place").parent('.input-icon').addClass('is-invalid');
              $("#place").parents('.form-group').addClass('has-error');
          } else {
              $("#place").parents('.form-group').addClass('has-success');
          }
      });
    },
    updateEvento(){
      console.log(this.evento);
    },

    limpiarEvento(){
      $('#formEvento').trigger("reset");

      this.evento.title='';
      this.evento.place='';
      this.evento.description='';
      this.evento.start='';
      this.evento.end = null;
      this.evento.color='';

    },
    limpiarInputs(){
      $('.has-error').removeClass('has-error');
      $('.has-success').removeClass('has-success');
      $('.is-invalid').removeClass('is-invalid');
      this.errors.title = null;
      this.errors.place = null;
    }
  }
}
</script>

<style lang='scss'>

  @import '~@fullcalendar/core/main.css';
  @import '~@fullcalendar/daygrid/main.css';
  @import '~@fullcalendar/timegrid/main.css';

</style>