<template>
<v-container fluid >
  <form @submit.prevent="savePost">
    <v-card class="yellow lighten-3">
      <v-card-title>
        <span class="headline">Pendaftaran</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col class="d-flex" cols="6" sm="4" md="4">
              <v-autocomplete :items="jenispendaftaran" item-text="keterangan" 
              item-value="id" v-model="form.jenispendaftaran"  label="Jenis Pendaftaran" name="jenispendaftaran" return-object outlined dense clearable required></v-autocomplete>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field v-model="form.nouji" name="nouji" label="No Uji" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="noregistrasikendaraan" v-model="form.noregistrasikendaraan" label="No Kendaraan" outlined dense clearable required></v-text-field>
            </v-col>
            
          </v-row>
          <v-row justify="center">
            <v-col v-if="form.jenispendaftaran.id != 1 " cols="12" sm="4" md="4">
              <v-btn @click="cariData()" class="ma-3" tile outlined color="success">
                <v-icon left>mdi-account-search</v-icon> Cari Data 
              </v-btn>
             </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="nama" v-model="form.nama" label="Nama" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="noidentitaspemilik" v-model="form.noidentitaspemilik" label="Nomer Identitas" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-textarea filled auto-grow row="4" v-model="form.alamat" row-height="10" name="alamat" label="Alamat" outlined dense clearable required></v-textarea>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="nosertifikatreg" v-model="form.nosertifikatreg" label="No Sertifikat Reg" outlined dense required clearable></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-menu ref="menu" v-model="menu":close-on-content-click="false" :return-value.sync="date"
                transition="scale-transition" offset-y min-width="290px">
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field v-model="form.tglsertifikatreg" name="tglsertifikatreg" label="Tgl Sertifikat Reg" outlined dense required v-bind="attrs" v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="form.tglsertifikatreg" no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                  <v-btn text color="primary" @click="$refs.menu.save(form.tglsertifikatreg)">OK</v-btn>
                </v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12" sm="4" md="4">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-autocomplete  :items="merek" item-text="merek" 
                      item-value="merek" v-model="form.merek" name="merek" dense required outlined label="Merek">
                    </v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="dialog = !dialog">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-col>
        <v-col cols="12" sm="4" md="4">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-autocomplete  :items="tipe" item-text="tipe" 
                      item-value="tipe" v-model="form.tipe" name="tipe" dense required outlined label="Tipe">
                    </v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="dialogtipe = !dialogtipe">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="thpembuatan" v-model="form.thpembuatan" label="Tahun Pembuatan" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="isisilender" v-model="form.isisilinder"  label="Isi Silender" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col class="d-flex" cols="12" sm="4" md="4">
              <v-select :items="bahanbakar" v-model="form.bahanbakar" name="bahanbakar" label="Bahan Bakar" return-object outlined dense clearable required></v-select>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="nomesin" v-model="form.nomesin" label="Nomer Mesin" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col cols="12" sm="4" md="4">
              <v-text-field name="norangka" v-model="form.norangka" label="Nomer Rangka" outlined dense clearable required></v-text-field>
            </v-col>
            <v-col v-if="form.jenispendaftaran.id === 5  || form.jenispendaftaran.id === 6 || form.jenispendaftaran.id === 9 || form.jenispendaftaran.id === 10 " class="d-flex" cols="12" sm="4" md="4">
              <v-autocomplete :items="kodewilayah" item-text="namawilayah" 
              item-value="kodewilayah" name="kodewilayah" v-model="form.kodewilayah"  label="Daerah" return-object outlined dense clearable required></v-autocomplete>
            </v-col>
            <v-col v-if="form.jenispendaftaran.id === 5 || form.jenispendaftaran.id === 6 || form.jenispendaftaran.id === 9 || form.jenispendaftaran.id === 10" class="d-flex" cols="12" sm="4" md="4">
              <v-autocomplete :items="kodewilayah" item-text="namawilayah" 
              item-value="kodewilayah" v-model="form.kodewilayahasal" name="kodewilayahasal" label="Daerah Asal" return-object outlined dense clearable required></v-autocomplete>
            </v-col>
            <v-col v-if="this.$route.params.id" class="d-flex" cols="12" sm="4" md="4">
              <v-autocomplete :items="kodewilayah" item-text="namawilayah" 
              item-value="kodewilayah" name="kodewilayah" v-model="form.kodewilayah"  label="Daerah" return-object outlined dense clearable required></v-autocomplete>
            </v-col>
            <v-col v-if="this.$route.params.id" class="d-flex" cols="12" sm="4" md="4">
              <v-autocomplete :items="kodewilayah" item-text="namawilayah" 
              item-value="kodewilayah" v-model="form.kodewilayahasal" name="kodewilayahasal" label="Daerah Asal" return-object outlined dense clearable required></v-autocomplete>
            </v-col>
            <v-col class="d-flex" cols="12" sm="4" md="4">
              <v-select :items="peruntukan" v-model="form.peruntukan" name="peruntukan" label="Peruntukan" return-object outlined dense clearable required></v-select>
            </v-col>
            <v-col class="d-flex" cols="12" sm="4" md="4">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-autocomplete :items="jeniskendaraan" item-text="jenis" 
                    item-value="jenis" v-model="form.jeniskendaraan" name="jeniskendaraan" label="Jenis Kendaraan" return-object outlined dense clearable required></v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-btn class="v-btn-simple" color="error" icon v-on="on" @click="dialogjenis = !dialogjenis">
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
              
            </v-col>

            <v-col class="d-flex" cols="12" sm="4" md="4">
            <v-menu ref="menu2" v-model="menu2":close-on-content-click="false" :return-value.sync="form.tglpendaftaran"
              transition="scale-transition" offset-y min-width="290px">
              <template v-slot:activator="{ on, attrs }">
                <v-text-field v-model="form.tglpendaftaran" name="tglpendaftaran" label="Tgl Pendaftaran" outlined dense required v-bind="attrs" v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="form.tglpendaftaran" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu2 = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.menu2.save(form.tglpendaftaran)">OK</v-btn>
              </v-date-picker>
            </v-menu>
            </v-col>

            <v-col class="d-flex" cols="12" sm="4" md="4">
            <v-menu ref="menu1" v-model="menu1":close-on-content-click="false" :return-value.sync="form.tglbayar"
              transition="scale-transition" offset-y min-width="290px">
              <template v-slot:activator="{ on, attrs }">
                <v-text-field v-model="form.tglbayar" name="tglbayar" label="Tgl Bayar" outlined dense required v-bind="attrs" v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="form.tglbayar" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu1 = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.menu1.save(form.tglbayar)">OK</v-btn>
              </v-date-picker>
            </v-menu>
            </v-col>

            <v-col class="d-flex" cols="12" sm="4" md="4">
            <v-menu ref="menu3" v-model="menu3":close-on-content-click="false" :return-value.sync="form.masaberlakuuji"
              transition="scale-transition" offset-y min-width="290px">
              <template v-slot:activator="{ on, attrs }">
                <v-text-field v-model="form.masaberlakuuji" name="masaberlakuuji" label="Masa Berlaku Uji" outlined dense required v-bind="attrs" v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="form.masaberlakuuji" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu3 = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.menu3.save(form.masaberlakuuji)">OK</v-btn>
              </v-date-picker>
            </v-menu>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>

      <v-col cols="12">
        <v-card class="mx-auto yellow lighten-3">
        <v-card-title>Daya Angkut, Jumlah Berat, dan Kemampuan kendaraan</v-card-title>
        <v-card-subtitle>
        <v-row>
            <v-col cols="12" sm="6" md="3">
              <v-text-field label="JBB (Kg)" name="jbb" v-model="form.jbb" type="number"  outlined dense required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="3">
              <v-text-field label="JBKB (Kg)" name="jbkb" v-model="form.jbkb" type="number"  outlined dense required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field label="Kelas Jalan Terendah" name="kelasjalanterendah" v-model="form.kelasjalanterendah" type="text" value="III" outlined dense required clearable></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field label="Konfigurasi Sumbu Roda" name="konfigurasisumburoda" v-model="form.konfigurasisumburoda" type="text" value="" outlined dense required clearable></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field label="Ukuran Ban" name="ukuranban" v-model="form.ukuranban" type="text" outlined dense required clearable></v-text-field>
            </v-col>
        </v-row>
        </v-card-subtitle>
        </v-card>
        </v-col>

        <v-col cols="12">
          <v-card class="mx-auto yellow lighten-3">
          <v-card-title>Jarak Sumbu</v-card-title>
          <v-card-subtitle>
          <v-row>
              <v-col cols="12" sm="6" md="3">
                <v-text-field label="I-II (mm)" name="jaraksumbu1_2" v-model="form.jaraksumbu1_2" type="number"  outlined dense required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field label="II-III (mm)" name="jaraksumbu2_3" v-model="form.jaraksumbu2_3" type="number"  outlined dense required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field label="III-IV (mm)" name="jaraksumbu3_4" v-model="form.jaraksumbu3_4" type="number"  outlined dense required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field label="Q  (mm)" type="number" name="q" v-model="form.q"  outlined dense required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="3">
                <v-text-field label="P (mm)" name="p" v-model="form.p" type="number"  outlined dense required></v-text-field>
              </v-col>
          </v-row>
          </v-card-subtitle>
          </v-card>
          </v-col>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="goBack()">Cancel</v-btn>
        <v-btn v-if="this.$route.params.id" outlined @click="editPost($route.params.id)" color="success">save</v-btn>
            <v-btn v-else outlined type="submit" color="success">save</v-btn>
      </v-card-actions>
  </form>

  <v-dialog v-model="dialogjenis" width="800px" >
    <form @submit.prevent="saveJenis">
      <v-card>
        <v-card-title class="grey darken-2">
          Create Tipe
        </v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="4">
              <v-text-field placeholder="Jenis" v-model="formjenis.jenis" name="jenis" class="inputUp"  dense required outlined ></v-text-field>
            </v-col><v-col cols="4">
              <v-autocomplete  :items="klasifikasi" item-text="klasifikasis" 
              item-value="id" v-model="formjenis.klasifikasi" name="klasifikasi" dense required outlined label="Klasifikasi">
            </v-autocomplete>
            </v-col>
            </v-col><v-col cols="4">
              <v-autocomplete  :items="jeniskendaraanIntegrasi" item-text="jeniskendaraan" 
              item-value="jeniskendaraan" v-model="formjenis.jeniskendaraan" name="jeniskendaraan" dense required outlined label="Jenis Kendaraan Kementrian">
            </v-autocomplete>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialogjenis = false" >Cancel</v-btn>
          <v-btn text type="submit">Save</v-btn>
        </v-card-actions>
      </v-card>
      </form>
    </v-dialog>


  <v-dialog v-model="dialog" width="800px" >
  <form @submit.prevent="saveMerek">
      <v-card>
        <v-card-title class="grey darken-2">
          Create Merek
        </v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="12">
              <v-text-field prepend-icon="mdi-mail" v-model="formmerek.merek" name="merek" class="inputUp" placeholder="Merek" ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialog = false" >Cancel</v-btn>
          <v-btn text type="submit">Save</v-btn>
        </v-card-actions>
      </v-card>
    </form>
    </v-dialog>

    <v-dialog v-model="dialogtipe" width="800px" >
    <form @submit.prevent="saveTipe">
      <v-card>
        <v-card-title class="grey darken-2">
          Create Tipe
        </v-card-title>
        <v-container>
          <v-row class="mx-2">
            <v-col cols="6">
              <v-autocomplete  :items="merek" item-text="merek" 
              item-value="id" v-model="formtipe.merek" name="merek" dense required outlined label="Merek">
            </v-autocomplete>
            </v-col>
            <v-col cols="6">
              <v-text-field placeholder="Tipe" v-model="formtipe.tipe" name="tipe" class="inputUp"  dense required outlined ></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="dialogtipe = false" >Cancel</v-btn>
          <v-btn text type="submit">Save</v-btn>
        </v-card-actions>
      </v-card>
      </form>
    </v-dialog>
</v-container>
</template>

<script>
export default {
    data() {
        return ({
            post: {},
            dialogjenis:false,
            jeniskendaraan: [],
            jeniskendaraanIntegrasi: [],
            jenispendaftaran: [],
            klasifikasi: [],
            kodewilayah: [],
            menu3: false,
            menu2: false,
            menu1: false,
            menu: false,
            merek: [],
            tipe: [],
            dialog: false,
            dialogtipe : false,
            date: new Date().toISOString().substr(0, 10),
            bahanbakar : [ 'Bensin', 'Solar', 'Gas' ],
            peruntukan : [ 'Umum', 'Tidak Umum', 'Pemerintah' ],
            form: new Form({
                jenispendaftaran: '',
                nouji: '',
                noregistrasikendaraan: '',
                nama: '',
                noidentitaspemilik: '',
                alamat: '',
                nosertifikatreg: '',
                tglsertifikatreg: new Date().toISOString().substr(0, 10),
                masaberlakuuji: new Date().toISOString().substr(0, 10),
                merek: '',
                tipe: '',
                thpembuatan: '',
                isisilinder: '',
                bahanbakar: '',
                nomesin: '',
                norangka: '',
                jbb: '0',
                kodewilayah: '',
                kodewilayahasal: '',
                peruntukan: '',
                jeniskendaraan:'',
                tglpendaftaran: new Date().toISOString().substr(0, 10),
                tglbayar: new Date().toISOString().substr(0, 10),
                jbkb: '0',
                kelasjalanterendah: '',
                konfigurasisumburoda: '',
                ukuranban:  '',
                jaraksumbu1_2: '0',
                jaraksumbu2_3: '0',
                jaraksumbu3_4: '0',
                p: '0',
                q:  '0',
            }),
            formjenis: new Form({
                jenis:'',
                klasifikasi: '',
                jeniskendaraan: '',
            }),
            formmerek: new Form({
                merek: '',
            }),
            formtipe: new Form({
                merek: '',
                tipe: '',
            }),
        })
    },
    methods: {
        goBack() {
          window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        },
        savePost() {
            this.form.post('/api/pendaftaran/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.$router.push('/admin/pendaftarans')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        saveJenis() {
            this.formjenis.post('/api/jenis/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.initialize();
                    this.dialogjenis = false;
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },

        saveMerek() {
            this.formmerek.post('/api/merek/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialog = false
                    axios({
                        url: '/api/mereks/',
                        method: "get"
                    })
                    .then((result) => {
                        this.merek = result.data.masters
                    }).catch((err) => {

                    });
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        saveTipe() {
            this.formtipe.post('/api/tipe/new')
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    this.dialogtipe = false
                    axios({
                        url: '/api/tipe/',
                        method: "get"
                    })
                    .then((result) => {
                        this.tipe = result.data.masters
                    }).catch((err) => {

                    });
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
                    this.form.jenispendaftaran= this.post.kodepenerbitans_id
                    this.form.nouji= this.post.nouji
                    this.form.noregistrasikendaraan= this.post.noregistrasikendaraan
                    this.form.nama= this.post.nama
                    this.form.noidentitaspemilik= this.post.noidentitaspemilik
                    this.form.alamat= this.post.alamat
                    this.form.nosertifikatreg = this.post.nosertifikatreg
                    this.form.tglsertifikatreg = this.post.tglsertifikatreg
                    this.form.thpembuatan= this.post.thpembuatan
                    this.form.isisilinder= this.post.isisilinder
                    this.form.bahanbakar= this.post.bahanbakar
                    this.form.nomesin= this.post.nomesin
                    this.form.norangka= this.post.norangka
                    this.form.jbb= this.post.jbb
                    this.form.jeniskendaraan= this.post.jenis
                    this.form.kodewilayah= this.post.kodewilayah
                    this.form.kodewilayahasal= this.post.kodewilayahasal
                    this.form.jeniskendaraan= this.post.jenis
                    this.form.peruntukan= this.post.peruntukan
                    this.form.tglpendaftaran= this.post.tglpendaftaran
                    this.form.tglbayar= this.post.tglbayar
                    this.form.masaberlakuuji= this.post.masaberlakuuji
                    this.form.merek= this.post.merek
                    this.form.tipe= this.post.tipe
                    this.form.kelasjalanterendah = this.post.kelasjalanterendah
                    this.form.ukuranban = this.post.ukuranban
                    this.form.konfigurasisumburoda = this.post.konfigurasisumburoda
                    this.form.jaraksumbu1_2 = this.post.jaraksumbu1_2
                    this.form.jaraksumbu2_3 = this.post.jaraksumbu2_3
                    this.form.jaraksumbu3_4 = this.post.jaraksumbu3_4
                    this.form.q = this.post.q
                    this.form.p = this.post.p
                }).catch((err) => {

                });
        },
        cariData() {
            axios({
                    url: '/api/caridata',
                    method: "post",
                    data: {
                    nouji: this.form.nouji,
                    noregistrasikendaraan: this.form.noregistrasikendaraan
                  }
                })
                .then((result) => {
                    Vue.set(this.$data, 'post', result.data.kendaraan)
                    this.form.jenispendaftaran= this.post.kodepenerbitans_id
                    this.form.nouji= this.post.nouji
                    this.form.noregistrasikendaraan= this.post.noregistrasikendaraan
                    this.form.nama= this.post.nama
                    this.form.noidentitaspemilik= this.post.noidentitaspemilik
                    this.form.alamat= this.post.alamat
                    this.form.nosertifikatreg = this.post.nosertifikatreg
                    this.form.tglsertifikatreg = this.post.tglsertifikatreg
                    this.form.thpembuatan= this.post.thpembuatan
                    this.form.isisilinder= this.post.isisilinder
                    this.form.bahanbakar= this.post.bahanbakar
                    this.form.nomesin= this.post.nomesin
                    this.form.norangka= this.post.norangka
                    this.form.jbb= this.post.jbb
                    this.form.jeniskendaraan= this.post.jenis
                    this.form.kodewilayah= this.post.kodewilayah
                    this.form.kodewilayahasal= this.post.kodewilayahasal
                    this.form.jeniskendaraan= this.post.jenis
                    this.form.peruntukan= this.post.peruntukan
                    this.form.masaberlakuuji= this.post.masaberlakuuji
                    this.form.merek= this.post.merek
                    this.form.tipe= this.post.tipe
                    this.form.kelasjalanterendah = this.post.kelasjalanterendah
                    this.form.ukuranban = this.post.ukuranban
                    this.form.konfigurasisumburoda = this.post.konfigurasisumburoda
                    this.form.jaraksumbu1_2 = this.post.jaraksumbu1_2
                    this.form.jaraksumbu2_3 = this.post.jaraksumbu2_3
                    this.form.jaraksumbu3_4 = this.post.jaraksumbu3_4
                    this.form.q = this.post.q
                    this.form.p = this.post.p
                }).catch((err) => {

                });
        },
        editPost(id) {
            this.form.patch('/api/pendaftaran/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                   this.$router.push('/admin/pendaftarans')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        initialize() {
            axios({
                    url: '/api/mereks/',
                    method: "get"
                })
                .then((result) => {
                    this.merek = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/tipe/',
                    method: "get"
                })
                .then((result) => {
                    this.tipe = result.data.masters
                }).catch((err) => {

                });
          axios({
                    url: '/api/kodewilayah/',
                    method: "get"
                })
                .then((result) => {
                    this.kodewilayah = result.data.kodewilayahs
                }).catch((err) => {

                });
          axios({
                    url: '/api/kodepenerbitan/',
                    method: "get"
                })
                .then((result) => {
                    this.jenispendaftaran = result.data.kodepenerbitans
                }).catch((err) => {

                });
          axios({
                    url: '/api/jenis/',
                    method: "get"
                })
                .then((result) => {
                    this.jeniskendaraan = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/jeniskendaraan/',
                    method: "get"
                })
                .then((result) => {
                    this.jeniskendaraanIntegrasi = result.data.masters
                }).catch((err) => {

                });
            axios({
                    url: '/api/klasifikasi/',
                    method: "get"
                })
                .then((result) => {
                    this.klasifikasi = result.data.masters
                }).catch((err) => {

                });
        },
    },
    mounted() {
        var id = this.$route.params.id
        if (id) {
            this.fetchPost(id)
        }

        this.initialize()
    }
}
</script>