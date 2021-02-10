<template>
<v-container fluid >
    <v-card color="lime lighten-3 black--text">
    <v-card-title>
      Mutasi Uji
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
      <v-btn bottom color="green" dark fab small @click="refreshPost">
        <v-icon>mdi-refresh</v-icon>
      </v-btn>
      <router-link to="/admin/mutasiall/">
      <v-btn bottom color="pink" dark >
        Mutasi Keseluruhan
      </v-btn>
      </router-link>
    </v-card-title>
    </v-card>
          <v-data-table :headers="headers" :items="pendaftarans" :search="search" class="elevation-1 yellow lighten-3">
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="primary" icon v-on="on" @click="print(item.id)">
                                <v-icon>mdi-printer-check</v-icon>
                            </v-btn>
                        </template>
                        <span>print</span>
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
            headers: [
                { text: 'No Kendaraan', value: 'identitaskendaraan.noregistrasikendaraan' },
                { text: 'No Uji', value: 'identitaskendaraan.nouji' },
                { text: 'Nama', value: 'identitaskendaraan.nama' },
                { text: 'Asal', value: 'identitaskendaraan.kodewilayahasal' },
                { text: 'Tujuan', value: 'identitaskendaraan.kodewilayah' },
                { text: 'Jenis Pendaftaran', value: 'kodepenerbitans.keterangan' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            form: new Form({}),
            halamanaksesmutasi: [],
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
                    this.form.delete('/api/pendaftarans/' + id)
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
        print(id){
            window.open('/cetak/'+id+'/printmt', "_blank");
        },
        refreshPost() {
            this.$store.dispatch('getPendaftaransmu');
        },
        editpendaftaran(id) {
            this.$router.push('/admin/pendaftaran/' + id)
        },
        initialize() {
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
                    this.halamanaksesmutasi = result.data.halamanakses

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
        this.$store.dispatch('getPendaftaransmu');
    },
    created() {
        Fire.$on('afterCreate', () => {
            this.refreshPost();
        })
        this.initialize();
        this.refreshPost();
    }
}
</script>
