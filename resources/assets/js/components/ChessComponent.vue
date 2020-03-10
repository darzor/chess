<template>
    <div class="row">
        <div v-if="igra_pocela">
            <div class="container">
                <button class="btn btn-success" @click="zavrsi_igru">Završi igru</button>
            </div>
        <h1 style="margin-left: 10%" v-if="pobjednik">Pobjednik: {{ (pobjednik == 'bijeli' ? 'Bijeli' : '') +  (pobjednik == 'crni' ? 'Crni' : '')}} igrač!</h1>
        <h1 style="margin-left: 10%" v-else >Na potezu je: {{ (this.boja == 'bijeli' ? 'Bijeli' : '') +  (this.boja == 'crni' ? 'Crni' : '')}} igrač!</h1>
        <h1 style="margin-left: 10%" v.if="bijeli_id && crni_id" >Moja boja: {{ (this.user_id == bijeli_id ? 'Bijeli' : '') +  (this.user_id == crni_id ? 'Crni' : '')}} !</h1>
        <table style="border: solid; margin-left: 10%; margin-top:5%">
            <tr v-if="ploca" v-for="(row, key1) in ploca">
                <td v-for="( col, key2 ) in row"
                    style="width: 50px; height: 50px; border: solid;"
                    v-on:click="click_ploca(key1, key2, col )"
                >
                    <div v-if="(key1 + key2) % 2" style="background: gray; width: 100%; border: solid; height: 100%" :style="{ 'border-color': col.border }">
                        <img v-if="col.ime == 'kralj' && col.boja == 'crni'" src="/css/icons/kralj_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'kraljica' && col.boja == 'crni'" src="/css/icons/kraljica_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'top' && col.boja == 'crni'" src="/css/icons/top_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'lovac' && col.boja == 'crni'" src="/css/icons/lovac_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'konj' && col.boja == 'crni'" src="/css/icons/konj_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'pjesak' && col.boja == 'crni'" src="/css/icons/pjesak_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'kralj' && col.boja == 'bijeli'" src="/css/icons/kralj_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'kraljica' && col.boja == 'bijeli'" src="/css/icons/kraljica_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'top' && col.boja == 'bijeli'" src="/css/icons/top_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'lovac' && col.boja == 'bijeli'" src="/css/icons/lovac_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'konj' && col.boja == 'bijeli'" src="/css/icons/konj_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'pjesak' && col.boja == 'bijeli'" src="/css/icons/pjesak_bijeli.png" style="height: 50px; width: 50px">
                    </div>
                    <div v-else style=" width: 100%; border: solid; height: 100%" :style="{ 'border-color': col.border }" >
                        <img v-if="col.ime == 'kralj' && col.boja == 'crni'" src="/css/icons/kralj_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'kraljica' && col.boja == 'crni'" src="/css/icons/kraljica_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'top' && col.boja == 'crni'" src="/css/icons/top_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'lovac' && col.boja == 'crni'" src="/css/icons/lovac_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'konj' && col.boja == 'crni'" src="/css/icons/konj_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'pjesak' && col.boja == 'crni'" src="/css/icons/pjesak_crni.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'kralj' && col.boja == 'bijeli'" src="/css/icons/kralj_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'kraljica' && col.boja == 'bijeli'" src="/css/icons/kraljica_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'top' && col.boja == 'bijeli'" src="/css/icons/top_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'lovac' && col.boja == 'bijeli'" src="/css/icons/lovac_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'konj' && col.boja == 'bijeli'" src="/css/icons/konj_bijeli.png" style="height: 50px; width: 50px">
                        <img v-else-if="col.ime == 'pjesak' && col.boja == 'bijeli'" src="/css/icons/pjesak_bijeli.png" style="height: 50px; width: 50px">
                    </div>
                </td>
            </tr>
        </table>
        </div>
        <div v-else>
            <br><br>
            <div class="container">
            <div v-for="zahtjev in zahtjevi" class="container">
                <div class="col-md-12">
                    <button class="btn btn-success" @click="prihvati_zahtjev(zahtjev.email)">Prihvati</button>
                    <button class="btn btn-danger" @click="odbij_zahtjev(zahtjev.email)">Obriši</button>
                    Imate zahtjev za igru od igrača: {{zahtjev.email}}</div>
            </div>
            </div>
            <hr>
            <div class="container">
                <div v-for="igrac in igraci" class="col-md-12">
                    <div class="col-md-12">
                        <button class="btn btn-success" @click="odaberi_igraca(igrac.email)" >Odaberi</button>
                        {{igrac.email}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChessComponent",
        data(){
            return {
                'ploca': [
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                    ['','','','','','','',''],
                ],
                'boja': null,
                'pobjednik': null,
                'oznacena_figurica': null,
                'igrac': null,

                'pusher':null,
                'channel':null,
                'user_id': null,
                'game_id': null,
                'crni_id': null,
                'bijeli_id':null,

                'igra_pocela': 0,
                'igraci': null,
                'zahtjevi': null
            }
        },
        methods:{

            zapocni_novu_igru(){
                let vm = this;
                axios.get( '/nova_igra/' + vm.game_id )
                    .then( function( response ) {
                        vm.ploca = response.data.ploca;
                        vm.boja = response.data.boja;
                        vm.pobjednik = response.data.pobjednik;
                        vm.igrac = response.data.igrac;
                    } ).catch(function(res) {
                        console.log( res );
                    });
            },

            dozvoljeni_potezi( col ){

                if( this.user_id != this.igrac ){
                    return;
                }

                let ploca = this.ploca;
                this.ploca = null;
                for( let r in ploca )
                    for( let s in ploca[r] ){
                        for( let t in col.dozvoljeni_potezi ){
                            if (ploca[r][s]){
                                ploca[r][s]['border'] = 'gray';
                                break;
                            }
                            else {
                                ploca[r][s] = {};
                                ploca[r][s]['border'] = 'gray';
                                break;
                            }
                        }
                    }
                for( let r in ploca )
                    for( let s in ploca[r] ){
                        for( let t in col.dozvoljeni_potezi ){
                            if( col.dozvoljeni_potezi[t][0] == r && col.dozvoljeni_potezi[t][1] == s ) {
                                if (ploca[r][s]){
                                    ploca[r][s]['border'] = 'red';
                                    break;
                                }
                                else {
                                    ploca[r][s] = {};
                                    ploca[r][s]['border'] = 'red';
                                    break;
                                }
                            }
                        }
                    }

                this.ploca = ploca;

            },

            povuci_potez(i,j){
                let vm = this;
                axios.post( '/povuci_potez/' + vm.game_id, {
                    'figurica': this.oznacena_figurica,
                    'pozicija': [ i, j ],
                    'ploca' : this.ploca,
                    'boja' : this.boja
                } )
                    .then( function( response ) {
                        vm.ploca = null;
                        vm.boja = null;
                        vm.pobjednik = null;
                        vm.igrac = null;
                        vm.ploca = response.data.ploca;
                        vm.boja = response.data.boja;
                        vm.pobjednik = response.data.pobjednik;
                        vm.igrac = response.data.igrac;
                    } ).catch(function(res) {
                        console.log( res );
                });
            },

            click_ploca( i, j, col  ){

                if( this.user_id != this.igrac ){
                    return;
                }

                if( !this.pobjednik )
                    if( col.ime && col.boja == this.boja ){
                        this.oznacena_figurica = col;
                        this.dozvoljeni_potezi(col)
                    } else {
                        if( this.oznacena_figurica ){
                            for( let k in this.oznacena_figurica.dozvoljeni_potezi )
                                if( this.oznacena_figurica.dozvoljeni_potezi[k][0] == i && this.oznacena_figurica.dozvoljeni_potezi[k][1] == j  )
                                    this.povuci_potez(i, j);
                        }
                    }
            },

            zavrsi_igru(){
                let vm = this;
                axios.post( '/zavrsi_igru', {
                    'game_id': vm.game_id,
                } )
                    .then( function( response ) {
                        vm.channel = null;
                        vm.igra_pocela = null;
                    } ).catch(function(res) {
                    console.log( res );
                });
            },

            nastavi_kasnije(){
                let vm = this;
                axios.post( '/nastavi_kasnije', {
                    'email': email,
                } )
                    .then( function( response ) {
                        vm.channel = null;
                        vm.igra_pocela = null;
                    } ).catch(function(res) {
                    console.log( res );
                });
            },

            odaberi_igraca( email ){
                let vm = this;
                axios.post( '/odaberi_igraca', {
                    'email': email,
                } )
                    .then( function( response ) {
                        vm.channel = response.data.channel;
                        vm.game_id = response.data.game_id;
                        vm.crni_id = response.data.crni;
                        vm.bijeli_id = response.data.bijeli;
                        vm.igra_pocela = true;
                        vm.zapocni_novu_igru();
                        var ch2 = vm.pusher.subscribe('chessChannel');
                        ch2.bind( vm.channel, function(data) {
                            vm.ploca = null;
                            vm.boja = null;
                            vm.pobjednik = null;
                            vm.igrac = null;
                            console.log( data );
                            vm.ploca = data.igra.ploca;
                            vm.boja = data.igra.boja;
                            vm.pobjednik = data.igra.pobjednik;
                            vm.igrac = data.igra.igrac;
                        });
                    } ).catch(function(res) {
                    console.log( res );
                });


            },

            prihvati_zahtjev( email ){
                let vm = this;
                axios.post( '/prihvati_zahtjev', {
                    'email': email,
                } )
                    .then( function( response ) {
                        vm.igra_pocela = true;
                        vm.channel = response.data.channel;
                        vm.game_id = response.data.game_id;
                        vm.crni_id = response.data.crni;
                        vm.bijeli_id = response.data.bijeli;
                        vm.zapocni_novu_igru();
                        var ch2 = vm.pusher.subscribe('chessChannel');
                        ch2.bind( vm.channel, function(data) {
                            vm.ploca = null;
                            vm.boja = null;
                            vm.pobjednik = null;
                            vm.igrac = null;
                            vm.ploca = data.igra.ploca;
                            vm.boja = data.igra.boja;
                            vm.pobjednik = data.igra.pobjednik;
                            vm.igrac = data.igra.igrac;
                        });
                    } ).catch(function(res) {
                    console.log( res );
                });


            },

            odbij_zahtjev( email ){
                let vm = this;
                axios.post( '/odbij_zahtjev', {
                    'email': email,
                } )
                    .then( function( response ) {
                        vm.channel = null;
                        vm.igra_pocela = null;
                        vm.igraci = response.data.igraci;
                        vm.zahtjevi = response.data.zahtjevi;
                        vm.user_id = response.data.user_id;
                    } ).catch(function(res) {
                    console.log( res );
                });


            },


            pocetak(){
                let vm = this;
                axios.get( '/odaberi_suparnika/1')
                    .then( function( response ) {
                        vm.igraci = response.data.igraci;
                        vm.zahtjevi = response.data.zahtjevi;
                        vm.user_id = response.data.user_id;

                        var ch1 = vm.pusher.subscribe('startChannel');
                        ch1.bind( vm.user_id, function(data) {
                            vm.pocetak2()
                        });

                    } ).catch(function(res) {
                    console.log( res );
                });

            },

            pocetak2(){
                let vm = this;
                axios.get( '/odaberi_suparnika/0')
                    .then( function( response ) {
                        vm.igraci = response.data.igraci;
                        vm.zahtjevi = response.data.zahtjevi;
                        vm.user_id = response.data.user_id;
                    } ).catch(function(res) {
                    console.log( res );
                });
            },

        },
        mounted(){

            let vm = this;

            Pusher.logToConsole = true;

            this.pusher = new Pusher('cca3a83d20a5f1b5b204', {
                cluster: 'eu',
                encrypted: true
            });
            vm.pocetak();


        },

    }
</script>

<style scoped>

</style>