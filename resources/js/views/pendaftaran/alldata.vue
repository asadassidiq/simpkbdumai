<template>
<v-container fluid >
      <router-link to="/admin/pendaftaran/">
      <v-btn  bottom color="pink" dark fab fixed right >
        <v-icon>mdi-plus</v-icon>
      </v-btn>
     </router-link>
    <v-card color="lime lighten-3 black--text">
    <v-card-title>
      Semua Data Pendaftaran
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
      <router-link to="/admin/pendaftarans/">
      <v-btn bottom color="pink" dark >
        Pendaftaran Hari ini
      </v-btn>
     </router-link>
    </v-card-title>
    </v-card>
          <v-data-table :headers="headers1" :items="pendaftarans" :search="search" class="elevation-1 yellow lighten-3" >
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn  class="v-btn-simple" color="success" icon v-on="on" @click="editpendaftaran(item.id)">
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </template>
                        <span>edit</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}" v-if="item.pos1 == NULL ">
                            <v-btn class="v-btn-simple" color="accent" icon v-on="on" @click="lanjutuji(item.id)">
                                <v-icon>mdi-account-arrow-right</v-icon>
                            </v-btn>
                        </template>
                        <span>lanjut uji</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="print(item.identitaskendaraan_id)">
                                <v-icon>mdi-pdf-box</v-icon>
                            </v-btn>
                        </template>
                        <span>pdf</span>
                    </v-tooltip>
                    <v-tooltip top v-if="halamanaksespendaftaran.delete == '1' ">
                        <template v-slot:activator="{on}">
                            <v-btn  class="v-btn-simple" color="error" icon v-on="on" @click="deletependaftaran(item.id)">
                                <v-icon>mdi-trash-can</v-icon>
                            </v-btn>
                        </template>
                        <span>delete</span>
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
                { text: 'Jbb', value: 'identitaskendaraan.jbb' },
                { text: 'Th Pembuatan', value: 'identitaskendaraan.thpembuatan' },
                { text: 'Berlaku Uji', value: 'masaberlakuuji' },
                { text: 'Jenis Pendaftaran', value: 'kodepenerbitans.keterangan' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            halamanaksespendaftaran: [],
            form: new Form({})
        }
    },
    methods: {
        deletependaftaran(id) {
            Swal.fire({
                title: 'Anda yakin hapus pendaftaran ini?',
                text: "Silahkan pastikan data yang di hapus benar!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    this.form.delete('/api/pendaftaran/' + id)
                     Fire.$emit('afterCreate')
                        Swal.fire(
                            'Deleted!',
                            'success'
                        )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Swal.fire(
                        'Cancelled',
                        'Data masih tersimpan)',
                        'error'
                    )
                }
            })
        },
        print1(id){
            window.open('/cetak/'+id+'/printlmbrpermohonan', "_blank");
        },
        print2(id){
            window.open('/cetak/'+id+'/printlmbrpemeriksaan', "_blank");
        },
        refreshPostpend() {
            this.$store.dispatch('getPendaftaranall');
        },
        editpendaftaran(id) {
            this.$router.push('/admin/pendaftaran/' + id)
        },
        lanjutuji(id) {
            axios({
                    url: '/api/lanjutuji/'+id,
                    method: "post",
                })
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                }).catch((err) => {

                });
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
        this.$store.dispatch('getPendaftaranall');
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
