<template>
<v-container fluid >
  <form @submit.prevent="savePost">
  <v-row dense>
    <v-col cols="12">
    <v-card color="lime lighten-3 black--text">
      <v-card-title>
        <span class="headline">Identitas Kendaraan</span>
      </v-card-title>
      <v-card-text>
        <v-container>
        <v-row>
        	<v-col cols="12" sm="3">
	          <v-text-field v-model="formdata.noregistrasikendaraan" label="Nomer Kendaraan" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field v-model="formdata.nouji" label="Nomer Uji" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field v-model="formdata.nama" label="Nama Pemilik" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field  label="Jenis Kendaraan" v-model="formdata.jenis" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field  v-model="formdata.jbb" label="JBB" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-text-field  label="Peruntukan" v-model="formdata.peruntukan" outlined readonly></v-text-field>
	        </v-col>
	        <v-col cols="12" sm="3">
	          <v-autocomplete :items="jenispendaftaran" item-text="keterangan" 
              item-value="id" v-model="formdata.jenispendaftaran"  label="Jenis Pendaftaran" name="jenispendaftaran" return-object outlined dense readonly></v-autocomplete>
	        </v-col>
        </v-row>
      	</v-container>
      </v-card-text>
     </v-card>
     </v-col>

    <v-col cols="12">
     <v-card color="lime lighten-3 black--text">
      <v-card-title>
        <span class="headline">Transaksi</span>
      </v-card-title>
      <v-card-text>
        <v-container>
        <v-simple-table class="lime lighten-3 black--text">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left" width="80px">
                    Status
                  </th>
                  <th class="text-left">
                    Uraian
                  </th>
                  <th class="text-left">
                    Biaya
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><v-checkbox v-model="blangko" @click="setblangko()"></v-checkbox></td>
                  <td>Pengadaan Blangko</td>
                  <td><v-text-field v-model="form.blangko" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="retribusi" @click="setretribusi()"></v-checkbox></td>
                  <td>Jasa Pengujian</td>
                  <td><v-text-field v-model="form.retribusi" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox @click="setregistrasi()" v-model="registrasi"></v-checkbox></td>
                  <td>Pengolalaan Nomor</td>
                  <td><v-text-field  v-model="form.registrasi" solo></v-text-field></td>
                </tr>
                <tr>
                  <td><v-checkbox v-model="denda" @click="setdenda()"></v-checkbox></td>
                  <td>
                    <v-text-field label="Bulan Denda" min="0" v-model="form.blndenda" @change="getdenda()" type="number" outlined></v-text-field>
                  </td>
                  <td><v-text-field v-model="form.denda" solo></v-text-field></td>
                </tr>
                <tr class="text-right">
                    <td colspan="2">TOTAL</td>
                    <td><v-text-field v-model="form.total" solo></v-text-field></td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
      	</v-container>
      </v-card-text>
     </v-card>
     </v-col>
     </v-row>

     <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="goBack">Cancel</v-btn>
        <v-btn v-if="this.$route.params.id" outlined @click="editPost($route.params.id)" color="success">save</v-btn>
            <v-btn v-else outlined type="submit" color="success">save</v-btn>
      </v-card-actions>
    </v-card>
  </form>
</v-container>
</template>

<script>
export default {
    data() {
        return ({
            post: {},
            retribusi:true,
            blangko:true,
            registrasi:true,
            bukuuji:false,
            emisi:false,
            pengujiankeliling: false,
            numpangujidanmutasi: false,
            statuskepemilikan:false,
            perubahansifat:false,
            denda:false,
            items: ['Smart Card Baru', 'Smart Card Rusak', 'Smart Card Hilang','Smart Card Lama'],
            jenispendaftaran: [],
            biayadenda:'',
            form: new Form({
                buku: 0,
                ketbuku:'',
                pengujiankeliling: 0,
                registrasi: 0,
                blndenda:0,
                emisi: 0,
                numpangujidanmutasi: 0,
                denda: 0,
                perubahansifat:0,
                total:0,
                retribusi:0,
                blangko:0,
                statuskepemilikan: 0,
            }),

            formbuku : new Form({
                jenis: '',
                biaya: '',
            }),

            formdata: new Form({
                statuskepemilikan: 0,
                pengujiankelilingumum: 0,
                pengujiankelilingtidakumum: 0,
                numpangujidanmutasi: 0,
                emisi: 0,
                perubahansifat:0,
                denda: 0,
                registrasi: 0,
                retribusi: 0,
                blangko:0,
                noregistrasikendaraan:'',
                nama:'',
                nouji:'',
                jenis:'',
                peruntukan:'',
                jenispendaftaran:'',
            })
         })
    },
    methods: {
        savePost() {
            this.form.post('/api/transaksi/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.$router.push('/admin/transaksis')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        fetchPost(id) {
            axios({
                    url: '/api/pendaftaranid/'+ id,
                    method: "get"
                })
                .then((result) => {
                    Vue.set(this.$data, 'post', result.data.kendaraan)
                    this.formdata.nouji= this.post.nouji
                    this.formdata.noregistrasikendaraan= this.post.noregistrasikendaraan
                    this.formdata.jenispendaftaran= this.post.kodepenerbitans_id
                    this.formdata.nama= this.post.nama
                    this.formdata.peruntukan= this.post.peruntukan
                    this.formdata.jbb= this.post.jbb
                    this.formdata.jenis= this.post.jenis
                    if(this.post.kartu > 0){
                    this.form.buku = this.post.kartu
                    this.formbuku.jenis = this.post.ketkartu
                    this.form.ketbuku = this.post.ketkartu
                    this.bukuuji = true
                    }
                    if(this.post.emisi > 0){
                    this.form.emisi = this.post.emisi
                    this.emisi = true
                    }
                    if(this.post.perubahansifat > 0){
                    this.form.perubahansifat = this.post.perubahansifat
                    this.perubahansifat = true
                    }
                    if(this.post.perubahanstatus > 0){
                    this.form.statuskepemilikan = this.post.statuskepemilikan
                    this.statuskepemilikan = true
                    }
                    if(this.post.pengujiankeliling > 0){
                    this.form.pengujiankeliling = this.post.pengujiankeliling
                    this.pengujiankeliling = true
                    }
                    if(this.post.numpangujidanmutasi > 0){
                    this.form.numpangujidanmutasi = this.post.numpangujidanmutasi
                    this.numpangujidanmutasi = true
                    }
                    if(this.post.administrasi > 0){
                    this.form.registrasi = this.post.administrasi
                    this.registrasi = true
                    }
                    if(this.post.jasapengujian > 0){
                    this.form.retribusi = this.post.jasapengujian
                    this.retribusi = true
                    }
                    if(this.post.blangko > 0){
                    this.form.blangko = this.post.blangko
                    this.blangko = true
                    }
                    if(this.post.blndenda > 0){
                    this.form.blndenda = this.post.blndenda
                    this.form.denda = this.post.denda
                    this.denda = true
                    }
                    if(this.post.total > 0){
                    this.form.total = this.post.total
                    }
                    if(!this.post.total){
                     this.form.total = this.form.retribusi+this.form.registrasi+this.form.blangko
                    }
                }).catch((err) => {

                });
        },
        editPost(id) {
            this.form.patch('/api/transaksi/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/transaksis')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        getbukuuji(){
           this.formbuku.post('/api/cekhargabuku')
                .then((result) => {
                    this.formbuku.biaya = result.data.masters.biaya
                    this.form.ketbuku = this.formbuku.jenis
                }).catch((err) => {
                
                });
        },
        getdenda(){
            this.formdata.denda = this.form.blndenda*this.biayadenda;
            this.form.denda = this.form.blndenda*this.biayadenda;
        },
        setstatuskepemilikan(){
            if(this.statuskepemilikan === true){ 
               this.form.total = this.form.total+this.formdata.statuskepemilikan
               this.form.statuskepemilikan = this.formdata.statuskepemilikan
            }
            else{
                this.form.total = this.form.total-this.formdata.statuskepemilikan
                this.form.statuskepemilikan = 0
            }
        },
        setblangko(){
            if(this.blangko === false){
                this.form.total = this.form.total-7500
                this.form.blangko = 0
            }
            else{
                this.form.total = this.form.total+7500
                this.form.blangko = 7500
            }
        },
        setretribusi(){
            if(this.retribusi === false){
                this.form.total = this.form.total-this.formdata.retribusi
                this.form.retribusi = 0
            }
            else{
                this.form.total = this.form.total+this.formdata.retribusi
                this.form.retribusi = this.formdata.retribusi
            }
        },
        setregistrasi(){
            if(this.registrasi === false){
                this.form.total = this.form.total-this.formdata.registrasi
                this.form.registrasi = 0
            }
            else{
                this.form.total = this.form.total+this.formdata.registrasi
                this.form.registrasi = this.formdata.registrasi
            }
        },
        setperubahansifat(){
            if(this.perubahansifat === true){
                this.form.total = this.form.total+this.formdata.perubahansifat
                this.form.perubahansifat = this.formdata.perubahansifat
            }
            else{
                this.form.total = this.form.total-this.formdata.perubahansifat
                this.form.perubahansifat = 0
            }
        },
        setemisi(){
            if(this.emisi === true){
                this.form.total = this.form.total+this.formdata.emisi
                this.form.emisi = this.formdata.emisi
            }
            else{
                this.form.total = this.form.total-this.formdata.emisi
                this.form.emisi = 0
            }
        },
        setnumpangujidanmutasi(){
            if(this.numpangujidanmutasi === true){
                this.form.total = this.form.total+this.formdata.numpangujidanmutasi
                this.form.numpangujidanmutasi = this.formdata.numpangujidanmutasi
            }
            else{
                this.form.total = this.form.total-this.formdata.numpangujidanmutasi
                this.form.numpangujidanmutasi = 0
            }
        },
        setpengujiankeliling(){
            if(this.pengujiankeliling === true && this.formdata.peruntukan === 'Umum'){
                this.form.total = this.form.total+this.formdata.pengujiankelilingumum
                this.form.pengujiankeliling = this.formdata.pengujiankelilingumum
            }else if(this.pengujiankeliling === true && this.formdata.peruntukan === 'Tidak Umum' || this.formdata.peruntukan === 'Pemerintah'){
                this.form.total = this.form.total+this.formdata.pengujiankelilingtidakumum
                this.form.pengujiankeliling = this.formdata.pengujiankelilingtidakumum
            }else if(this.pengujiankeliling === false && this.formdata.peruntukan === 'Tidak Umum' || this.formdata.peruntukan === 'Pemerintah'){
                this.form.total = this.form.total-this.formdata.pengujiankelilingtidakumum
                this.form.pengujiankeliling = 0
            }else if(this.pengujiankeliling === false && this.formdata.peruntukan === 'Umum'){
                this.form.total = this.form.total-this.formdata.pengujiankelilingumum
                this.form.pengujiankeliling = 0
            }
            else{
                this.form.total = this.form.total-this.formdata.pengujiankeliling
                this.form.pengujiankeliling = 0
            }
            console.log(this.form)
        },
        setbukuuji(){
            if(this.bukuuji === true){
            this.form.total = this.form.total+this.formbuku.biaya
            this.form.buku = this.formbuku.biaya
            }
            else{
            this.form.total = this.form.total-this.formbuku.biaya
            this.form.buku = 0
            }
            
        },
        setdenda(){
            if(this.denda === true){
                this.form.total = this.form.total+this.formdata.denda
                this.form.denda = this.formdata.denda
            }
            else{
                this.getdenda()
                this.form.total = this.form.total-this.formdata.denda
                this.form.denda = 0
                this.form.blndenda = 0
            }
        },
        goBack() {
          window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        },
        initialize () {
          axios({
                    url: '/api/kodepenerbitan/',
                    method: "get"
                })
                .then((result) => {
                    this.jenispendaftaran = result.data.kodepenerbitans
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayadenda/',
                    method: "get"
                })
                .then((result) => {
                    this.biayadenda = result.data.biayadenda.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayastatuskepemilikan/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.statuskepemilikan = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayaperubahansifat/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.perubahansifat = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayanumpangujidanmutasi/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.numpangujidanmutasi = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayaemisi/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.emisi = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayapengujiankelilingumum/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.pengujiankelilingumum = result.data.biaya
                }).catch((err) => {

                });
            axios({
                    url: '/api/biayapengujiankelilingtidakumum/',
                    method: "get"
                })
                .then((result) => {
                    this.formdata.pengujiankelilingtidakumum = result.data.biaya
                }).catch((err) => {

                });

            axios({
                    url: '/api/retribusi/'+this.$route.params.id,
                    method: "get"
                })
                .then((result) => {
                    this.form.retribusi = result.data.retribusi.biaya
                    this.formdata.retribusi = result.data.retribusi.biaya
                    this.form.blangko = 7500
                }).catch((err) => {

                });
            axios({
                    url: '/api/registrasi/'+this.$route.params.id,
                    method: "get"
                })
                .then((result) => {
                    this.form.registrasi = result.data.registrasi.biaya
                    this.formdata.registrasi = result.data.registrasi.biaya
                }).catch((err) => {

                });
        },
    },
    mounted() {
        this.initialize()

        var id = this.$route.params.id
        if (id) {
            this.fetchPost(id)
        }

    }
}
</script>