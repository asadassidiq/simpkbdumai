<template>
<v-container fluid >
      <router-link to="/admin/pendaftaran/">
      <v-btn  bottom color="pink" dark fab fixed right >
        <v-icon>mdi-plus</v-icon>
      </v-btn>
     </router-link>
    <v-card color="lime lighten-3 black--text">
    <v-card-title>
      Pendaftaran
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
      <v-btn bottom color="green" dark fab small @click="refreshPostpend">
        <v-icon>mdi-refresh</v-icon>
      </v-btn>
      <router-link to="/admin/hasilujiall/">
      <v-btn bottom color="pink" dark >
        Data Keseluruhan
      </v-btn>
     </router-link>
    </v-card-title>
    </v-card>
          <v-data-table :headers="headers1" :items="pendaftarans" :search="search" class="elevation-1 yellow lighten-3" >
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn depressed color="blue lighten-1" x-small @click="print1(item.id)"> hal 1 </v-btn>
                        </template>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn depressed color="blue lighten-2" x-small @click="print23(item.id)"> hal 23 </v-btn>
                        </template>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn depressed color="blue lighten-3" x-small @click="print45(item.id)"> hal 45 </v-btn>
                        </template>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn depressed color="blue lighten-4" x-small @click="print6(item.id)"> hal 6 </v-btn>
                        </template>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn depressed color="blue lighten-5" x-small @click="print7(item.id)"> hal 7 </v-btn>
                        </template>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn  class="v-btn-simple" color="success" icon v-on="on" @click="print2(item.id)">
                                <v-icon>mdi-printer</v-icon>
                            </v-btn>
                        </template>
                        <span>Stiker</span>
                    </v-tooltip>
                </div>
            </template>
        </v-data-table>
    </v-container>
</template>
<script>
export default {
    data() {
        return {
            search: '',
            headers1: [
                { text: 'No Kendaraan', value: 'identitaskendaraan.noregistrasikendaraan' },
                { text: 'No Uji', value: 'identitaskendaraan.nouji' },
                { text: 'Nama', value: 'identitaskendaraan.nama' },
                { text: 'Berlaku Uji', value: 'masaberlakuuji' },
                { text: 'Jenis Pendaftaran', value: 'kodepenerbitans.keterangan' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            halamanaksespendaftaran: [],
            form: new Form({})
        }
    },
    methods: {
        print1(id){
            window.open('/cetak/'+id+'/printbukuujihal1', "_blank");
        },
        print23(id){
            window.open('/cetak/'+id+'/printbukuujihal23', "_blank");
        },
        print45(id){
            window.open('/cetak/'+id+'/printbukuujihal45', "_blank");
        },
        print6(id){
            window.open('/cetak/'+id+'/printbukuujihal6', "_blank");
        },
        print7(id){
            window.open('/cetak/'+id+'/printbukuujihal7', "_blank");
        },
        print2(id){
            window.open('/cetak/'+id+'/printstiker', "_blank");
        },
        refreshPostpend() {
            this.$store.dispatch('getPendaftarans');
        },
        initialize () {
            var id = JSON.parse(localStorage.getItem("user"));
            axios({
                    url: '/api/cekakses/',
                    method: "POST",
                    data: {
                    user_id: id.id,
                    halaman: '1',
                  }
                })
                .then((result) => {
                    this.halamanaksespendaftaran = result.data.halamanakses

                }).catch((err) => {

                });
        },
        
    },
    computed: {
        pendaftarans() {
            return this.$store.getters.pendaftarans;
        },
    },
    mounted() {
        if (this.pendaftarans.length) {
            return;
        }
        this.$store.dispatch('getPendaftarans');
    },
    created() {
        Fire.$on('afterCreate', () => {
            this.refreshPostpend();
        })
        this.initialize();
        this.refreshPostpend();
    }
}
</script>
