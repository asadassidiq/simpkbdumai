<template>
<v-container fluid >
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
      <v-btn bottom color="green" dark fab small @click="refreshPost">
        <v-icon>mdi-refresh</v-icon>
      </v-btn>
      <router-link to="/admin/transaksiall/">
      <v-btn bottom color="pink" dark >
        Transaksi Keseluruhan
      </v-btn>
     </router-link>
    </v-card-title>
    </v-card>
          <v-data-table :headers="headers" :items="pendaftarans" :search="search" class="elevation-1 yellow lighten-3">
            <template v-slot:item.status="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn depressed color="error" x-small v-if="item.status === null"> Belum Lunas </v-btn>
                            <v-btn depressed color="success" x-small  v-if="item.status == 1"> Lunas </v-btn>
                            <v-btn depressed color="error" x-small v-if="item.status == 0">Belum Lunas </v-btn>
                        </template>
                    </v-tooltip>
                </div>
            </template>
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="success" icon v-on="on" @click="editpendaftaran(item.id)">
                                <v-icon>mdi-cash-usd-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>pembayaran</span>
                    </v-tooltip>
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
            halamanaksestrans: [],
            headers: [
                { text: 'No Kendaraan', value: 'noregistrasikendaraan' },
                { text: 'No Uji', value: 'nouji' },
                { text: 'Nama', value: 'nama' },
                { text: 'Jbb', value: 'jbb' },
                { text: 'Th Pembuatan', value: 'thpembuatan' },
                { text: 'Jenis Pendaftaran', value: 'keterangan' },
                { text: 'Status', value: 'status' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
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
                    this.form.delete('/api/transaksi/' + id)
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
        initialize () {
            var id = JSON.parse(localStorage.getItem("user"));
      
        },
        print(id){
            window.open('/cetak/'+id+'/printkwitansi', "_blank");
        },
        refreshPost() {
            this.$store.dispatch('getPendaftarantrans');
        },
        editpendaftaran(id) {
            this.$router.push('/admin/transaksi/' + id)
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
        this.$store.dispatch('getPendaftarantrans');
    },
    created() {
        Fire.$on('afterCreate', () => {
            this.refreshPost();
        })
        this.refreshPost();
        this.initialize();
    }
}
</script>
