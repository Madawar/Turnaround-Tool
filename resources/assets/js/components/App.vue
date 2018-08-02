<template>
    <div class="d-flex flex-column h-100" @keyup.ctrl.40="changeAgenda">
        <!--
        <div class="cd d-flex flex-row" style="border-bottom:1px solid rgba(0, 40, 100, 0.12) ; display: none;">
            <div class="col-md-12">
                s
            </div>
        </div>
        -->
        <div  class="cd container- d-flex flex-row h-100 app-container" style="border:1px solid rgba(0, 40, 100, 0.12)">
            <div id="v-step-1" class="col-md-3 attendees " v-bar="{useScrollbarPseudo:false}" style="">
                <div>
                    <h5 class="shadow"><i class="fe fe-plus-square float-right"></i> <i class="fe fe-users"></i>
                        Attendees</h5>

                    <attendees :attendees="meeting.attendees" :meetingId="meetingId"></attendees>

                    <h5 class="second-heading">Actions</h5>
                    <div class="actions p-2">
                        <a  :href="'/minutes/pdf/' + meetingId"  target="_blank" class="btn btn-info btn-block"><i class="fe fe-eye"></i> View Draft Minutes</a>
                        <button @click="help" class="btn btn-warning btn-block"><i class="fe fe-help-circle"></i> Help</button>
                        <a :href="'minutes/finalize/' + meetingId"  class="btn btn-success btn-block"><i class="fe fe-save"></i> Finalize Meeting</a>
                    </div>
                </div>

            </div>
            <div id="v-step-0" v-bar="{useScrollbarPseudo:false}" class="col-md-6 minutes"
                 style="border-right:1px solid rgba(0, 40, 100, 0.12) ;border-left:1px solid rgba(0, 40, 100, 0.12) ;">
                <div >
                    <minutes :minutes="meeting.minutes" :meetingId="meetingId" :agenda="currentAgenda"></minutes>

                </div>

            </div>
            <div id="v-step-2"  class=" col-md-3 agenda " v-bar="{useScrollbarPseudo:false}" style="">
                <div>
                    <h5 class="shadow"><i class="fe fe-plus-square float-right"></i> <i class="fe fe-list"></i> Agenda
                    </h5>
                    <agenda :agendas="meeting.agenda" :meetingId="meetingId" :currentAgenda="currentAgenda"></agenda>

                    <h5 class="second-heading">Task List</h5>
                </div>
            </div>
        </div>
        <!--
                <div class="cd d-flex flex-row footer" style="border-top:1px solid rgba(0, 40, 100, 0.12) ;">
                    <div class="col-md-12">
                        <b>DAKIKA</b> &copy;
                    </div>
                </div>
        -->
        <v-tour name="myTour" :steps="steps"></v-tour>

    </div>
</template>

<script>

    import Attendees from "./attendees/Attendees";
    import minutes from "./minutes/minutes";
    import Agenda from "./agenda/agenda";

    export default {
        components: {
            Agenda,
            Attendees,
            minutes
        },
        name: 'app',
        props: {},
        data() {
            return {
                'rq': axios.create(),
                meeting: [],
                currentAgenda: {},
                loop: 0,
                meetingId: 0,
                steps: [
                    {
                        target: '#v-step-0',  // We're using document.querySelector() under the hood
                        content: `Welcome Start Typing to record your minutes you can use Attendees initials`
                    },
                    {
                        target: '#v-step-1',  // We're using document.querySelector() under the hood
                        content: `Click on a user to toggle their attendance`
                    },
                    {
                        target: '#v-step-2',  // We're using document.querySelector() under the hood
                        content: `This is your Meeting Agenda as you recorded them before your meeting`
                    },
                    {
                        target: '#v-step-3',  // We're using document.querySelector() under the hood
                        content: `Press CTRL + Down Arrow to move through your Agenda when typing minutes, You can use your attendants name in short form when writting meeting just use @ before the two letter shortform `
                    },
                    {
                        target: '#v-step-4',  // We're using document.querySelector() under the hood
                        content: `If you need to edit a minute just click on it, when you are done editing we will return you to the new minute text box`
                    }


                ]
            }
        },
        mounted() {

            this.meetingId = this.$route.query.meetingId;
            var vm = this;
            this.rq.get('/api/meeting' + '/' + this.meetingId)
                .then(function (response) {
                    console.log(response.data)
                    vm.meeting = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            console.log('mounted');
        },
        methods: {
            changeAgenda() {
                if (this.loop > this.meeting.agenda.length - 1) {
                    this.loop = 0;
                }
                this.currentAgenda = this.meeting.agenda[this.loop++]

            },
            help(){
                this.$tours['myTour'].start();
            }
        }
    }
</script>

<style>
    .list-group-item {
        font-size: 13px;
    }

    .media-content {
        font-size: 14px;
        line-height: 2;
    }

    .cd {
        background: white;
    }

    .app-container {
        margin-bottom: 2px;

        padding-right: 0px;
        padding-left: 0px;
    }

    .attendees, .agenda, .minutes {
        padding-right: 0px !important;
        padding-left: 0px !important;
        /* overflow: scroll;*/
    }

    /*
    .attendees::-webkit-scrollbar, .agenda::-webkit-scrollbar {
        width: 0px !important;
    }

    .agenda::-webkit-scrollbar {
        width: 0px !important;
    }
*/
    .app-body {

    }

    .minutes-body {
        border-bottom: 1px solid rgba(0, 40, 100, 0.12);
    }

    .agenda-badge {
        float: right;
        margin-bottom: 4px;
    }

    .media {
        /*
        margin-left: -8px;
        margin-right: -10px;
        */
        border-bottom: 1px solid rgba(0, 40, 100, 0.12);
        text-align: justify;
    }

    .minute-edit {
        border-bottom: 1px solid rgba(0, 40, 100, 0.12);
        /*
    margin-left: -8px;
    margin-right: -10px;
    */
    }

    .media:first-child {
        margin-top: 5px;
        border-top: 1px solid rgba(0, 40, 100, 0.12);
    }

    .media-body {
        line-height: 1.6;
        padding-bottom: 8px;
        margin-left: 20px;
        padding-bottom: 0px;
        /*
        margin-left: 0px;
        */
    }

    .media-heading h5 {
        margin-bottom: 0px;
        margin-left: -20px;
        font-size: 15px;
    }

    .attendees h5, .agenda h5, .status {
        text-align: center;
        padding: 10px;
        background: #f5f5f5;
        border-bottom: 1px solid rgba(0, 40, 100, 0.12);
        margin-bottom: 0px;

    }

    .shadow {
        -webkit-box-shadow: -2px 3px 11px -1px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: -2px 3px 11px -1px rgba(0, 0, 0, 0.75);
        box-shadow: -2px 3px 11px -1px rgba(0, 0, 0, 0.75);
    }

    .status {
        padding: 0px !important;
        background: #f6f9fb;
    }

    .second-heading {
        border-top: 1px solid rgba(0, 40, 100, 0.12);
    }

    .footer {
        text-align: center;
    }

    .vuebar-element {
        height: 250px;
        width: 100%;
        max-width: 500px;
        background: #dfe9fe;
    }

    .vb > .vb-dragger {
        z-index: 5;
        width: 12px;
        right: 0;
    }

    .vb > .vb-dragger > .vb-dragger-styler {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: rotate3d(0, 0, 0, 0);
        transform: rotate3d(0, 0, 0, 0);
        -webkit-transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        transition: background-color 100ms ease-out,
        margin 100ms ease-out,
        height 100ms ease-out;
        background-color: rgba(48, 121, 244, .1);
        margin: 5px 5px 5px 0;
        border-radius: 20px;
        height: calc(100% - 10px);
        display: block;
    }

    .vb.vb-scrolling-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(48, 121, 244, .3);
    }

    .vb > .vb-dragger:hover > .vb-dragger-styler {
        background-color: rgba(48, 121, 244, .5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(48, 121, 244, .5);
        margin: 0px;
        height: 100%;
    }

    .vb.vb-dragging-phantom > .vb-dragger > .vb-dragger-styler {
        background-color: rgba(48, 121, 244, .5);
    }
</style>
