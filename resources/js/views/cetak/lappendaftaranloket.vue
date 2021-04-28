<template>
<v-container fluid >
	<v-row>
        <v-col cols="4">
        	<v-card height="110" class="yellow lighten-3">
  					<v-col cols="12">
  					<v-row no-gutters>
  					<v-col cols="10">
		              <v-menu ref="menu" v-model="menu":close-on-content-click="false" :return-value.sync="formharian.tgl"
		                transition="scale-transition" offset-y min-width="290px">
		                <template v-slot:activator="{ on, attrs }">
		                  <v-text-field v-model="tglharian" name="tgl" label="Tanggal" outlined dense required v-bind="attrs" v-on="on"
		                  ></v-text-field>
		                </template>
		                <v-date-picker v-model="tglharian" no-title scrollable>
		                  <v-spacer></v-spacer>
		                  <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
		                  <v-btn text color="primary" @click="$refs.menu.save(tglharian)">OK</v-btn>
		                </v-date-picker>
		              </v-menu>
		            </v-col>
		            <v-col cols="2" class="text-center">
		            	<v-btn class="mx-2" fab dark small color="primary" @click="printharian">
      						<v-icon dark> mdi-printer </v-icon>
      					</v-btn>
		            </v-col>
		            <v-col cols="12" class="text-center">
		            	<p><b>LAPORAN HARIAN</b></p>
		            </v-col>
		            </v-row>
		            </v-col>
        	</v-card>
        </v-col>

        <v-col cols="4">
          <v-card height="110" class="yellow lighten-3">
            <v-col cols="12">
            <v-row no-gutters>
            <v-col cols="10">
                  <v-menu ref="menu1" v-model="menu1" :close-on-content-click="false" :return-value.sync="tglbulanan" offset-y max-width="290px" min-width="290px" >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="tglbulanan" label="Bulan" v-bind="attrs" outlined dense  v-on="on" ></v-text-field>
                  </template>
                  <v-date-picker v-model="tglbulanan" type="month" no-title scrollable > <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu1 = false" > Cancel </v-btn>
                    <v-btn text color="primary" @click="$refs.menu1.save(tglbulanan)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
                </v-col>
                <v-col cols="2" class="text-center">
                  <v-btn class="mx-2" fab dark small color="primary" @click="printbulanan">
                  <v-icon dark> mdi-printer </v-icon>
                </v-btn>
                </v-col>
                <v-col cols="12" class="text-center">
                  <p><b>LAPORAN BULANAN</b></p>
                </v-col>
                </v-row>
                </v-col>
          </v-card>
        </v-col>

        <v-col cols="4">
          <v-card height="170" class="yellow lighten-3">
            <v-col cols="12">
            <v-row no-gutters>
            <v-col cols="10">
                  <v-menu ref="menu6" v-model="menu6" :close-on-content-click="false" :return-value.sync="tgltriwulan1" offset-y max-width="290px" min-width="290px" >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="tgltriwulan1" label="Bulan 1" v-bind="attrs" outlined dense  v-on="on" ></v-text-field>
                  </template>
                  <v-date-picker v-model="tgltriwulan1" type="month" no-title scrollable > <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu6 = false" > Cancel </v-btn>
                    <v-btn text color="primary" @click="$refs.menu6.save(tgltriwulan1)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
                <v-menu ref="menu7" v-model="menu7" :close-on-content-click="false" :return-value.sync="tgltriwulan2" offset-y max-width="290px" min-width="290px" >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="tgltriwulan2" label="Bulan 2" v-bind="attrs" outlined dense  v-on="on" ></v-text-field>
                  </template>
                  <v-date-picker v-model="tgltriwulan2" type="month" no-title scrollable > <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu7 = false" > Cancel </v-btn>
                    <v-btn text color="primary" @click="$refs.menu7.save(tgltriwulan2)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="2" class="text-center">
              <v-btn class="mx-2" fab dark small color="primary" @click="printtriwulan">
              <v-icon dark> mdi-printer </v-icon>
            </v-btn>
            </v-col>
            <v-col cols="12" class="text-center">
              <p><b>LAPORAN TRIWULAN</b></p>
            </v-col>
            </v-row>
            </v-col>
          </v-card>
        </v-col>

        <v-col cols="4">
          <v-card height="110" class="yellow lighten-3">
            <v-col cols="12">
            <v-row no-gutters>
            <v-col cols="10">
                  <v-menu ref="menu5" v-model="menu5" :close-on-content-click="false" :return-value.sync="tglkutahuanan" offset-y max-width="290px" min-width="290px" >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="tgltahuanan" label="TAHUN" v-bind="attrs" outlined dense  v-on="on" ></v-text-field>
                  </template>
                  <v-date-picker v-model="tgltahuanan" type="year" no-title scrollable > <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu5 = false" > Cancel </v-btn>
                    <v-btn text color="primary" @click="$refs.menu5.save(tgltahuanan)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
                </v-col>
                <v-col cols="2" class="text-center">
                  <v-btn class="mx-2" fab dark small color="primary" @click="printtahunan">
                  <v-icon dark> mdi-printer </v-icon>
                </v-btn>
                </v-col>
                <v-col cols="12" class="text-center">
                  <p><b>LAPORAN TAHUANAN</b></p>
                </v-col>
                </v-row>
                </v-col>
          </v-card>
        </v-col>

        <v-col cols="4">
          <v-card height="110" class="yellow lighten-3">
            <v-col cols="12">
              <downloadexcel
                class="btn"
                :fetch="fetchData"
                :fields="json_fields"
                type="xls"
                name="dataUsers.xlsx"
              >
               <!-- :before-generate="startDownload"
                :before-finish="finishDownload" -->
                <button class="btn btn-primary mr">
                  <i class="fa fa-save"></i>
                  Export
                </button>
              </downloadexcel>
            </v-col>
          </v-card>
        </v-col>
    </v-row>

</v-container>
</template>

<script>
import downloadexcel from "vue-json-excel";
  export default {
    components: {
      downloadexcel
    },
    data() {
        return ({
            json_fields: {
              'Nama Pemilik / Perusahaan': 'nama',
              'No TNKB': 'noregistrasikendaraan',
              'NO STUK': 'nouji',
              'MEREK' : 'merek',
              'TYPE': 'tipe',
              'Jenis': 'jenis',
              'Panjang Kendaraan': 'panjangkendaraan',
              'Lebar Kendaraan': 'lebarkendaraan',
              'Tinggi Kendaraan': 'tinggikendaraan',
              'JBB': 'jbb',
            },
            menu: false,
            menu1: false,
            menu2: false,
            menu3: false,
            menu4: false,
            menu5: false,
            menu6: false,
            menu7: false,
            tglharian: new Date().toISOString().substr(0, 10),
            tglbulanan: new Date().toISOString().substr(0, 7),
            tgltriwulan1: new Date().toISOString().substr(0, 7),
            tgltriwulan2: new Date().toISOString().substr(0, 7),
            tgltahuanan: new Date().toISOString().substr(0, 4),
            tglkuharian : new Date().toISOString().substr(0, 10),
            tglkubulanan: new Date().toISOString().substr(0, 7),
            tglkutahuanan: new Date().toISOString().substr(0, 4),
            modal: false,
        	formharian: new Form({
        		tgl : new Date().toISOString().substr(0, 10),
        	})
        })
    },
    methods : {
    	printharian() {
            window.open('/cetak/'+this.formharian.tgl+'/laporanloketpendaftaran', "_blank");
        },
      printbulanan(){
            window.open('/cetak/'+this.tglbulanan+'/laporanloketpendaftaranbulanan', "_blank");
      },
      printtriwulan(){
            window.open('/cetak/'+this.tgltriwulan1+'/'+this.tgltriwulan2+'/laporanloketpendaftarantriwulan', "_blank");
      },
      printtahunan(){
            window.open('/cetak/'+this.tgltahuanan+'/laporanloketpendaftarantahunan', "_blank");
      },
    }
  }
</script>