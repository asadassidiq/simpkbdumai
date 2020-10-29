<template>
<v-container fluid >
    <v-col cols="12">
    <v-bottom-navigation :value="activeBtn" v-model="activeBtn" color="primary" horizontal >

        <v-btn v-show="halamanakses.view == '1'" @click="refreshPost()"><span>POS 1</span><v-icon>mdi-map-marker</v-icon></v-btn>

        <v-btn v-show="halamanakses2.view == '1'" @click="refreshPost()"><span>POS 2</span><v-icon>mdi-map-marker</v-icon></v-btn> 
        {{ activeBtn }}
      </v-bottom-navigation>
    </v-col>
    <v-card-title>
      DataKendaraan Lulus Uji
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
          <v-data-table :headers="headers" :items="pendaftarans" :search="search" class="elevation-1">
            <template v-slot:item.actions="{ item }">
                <div class="text-center d-flex align-center">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="success" icon v-on="on" @click="editpendaftaran(item.identitaskendaraan_id)">
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                        </template>
                        <span>edit</span>
                    </v-tooltip>
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                            <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="deletependaftaran(item.id)">
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
            headers: [
                { text: 'No Kendaraan', value: 'identitaskendaraan.noregistrasikendaraan' },
                { text: 'No Uji', value: 'identitaskendaraan.nouji' },
                { text: 'Nama', value: 'identitaskendaraan.nama' },
                { text: 'Th Pembuatan', value: 'identitaskendaraan.thpembuatan' },
                { text: 'Jenis Pendaftaran', value: 'kodepenerbitans.keterangan' },
                { text: 'Actions', value: 'actions', sortable: false },
            ],
            activeBtn: 0,
            halamanakses: [],
            halamanakses2: [],
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
        refreshPost() {
            if(this.activeBtn == 0){
                this.$store.dispatch('getDatakendaraanlulus1');
            }else{
                this.$store.dispatch('getDatakendaraanlulus2');
            }
        },
        editpendaftaran(id) {
            this.$router.push('/admin/pengujians/' + id)
        },
        initialize() {
            var id = JSON.parse(localStorage.getItem("user"));
            axios({
                    url: '/api/cekakses1/'+id.id,
                    method: "get",
                })
                .then((result) => {
                    this.halamanakses = result.data.halamanakses
                }).catch((err) => {

                });
            axios({
                    url: '/api/cekakses2/'+id.id,
                    method: "get",
                })
                .then((result) => {
                    this.halamanakses2 = result.data.halamanakses
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
        if(this.activeBtn == 0){
            this.$store.dispatch('getDatakendaraanlulus1');
        }else{
            this.$store.dispatch('getDatakendaraanlulus2');
        }
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
