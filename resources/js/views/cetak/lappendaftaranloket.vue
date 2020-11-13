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
		            	<p><b>LAPORAN PENDAFTARAN LOKET</b></p>
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
                  <v-menu ref="menu1" v-model="menu1" :close-on-content-click="false" :return-value.sync="date" offset-y max-width="290px" min-width="290px" >
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
                  <p><b>LAPORAN PENDAFTARAN LOKET</b></p>
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
                  <p><b>LAPORAN PENDAFTARAN LOKET</b></p>
                </v-col>
                </v-row>
                </v-col>
          </v-card>
        </v-col>
    </v-row>

    <v-row>
        <v-col cols="4">
          <v-card height="110" class="yellow lighten-3">
            <v-col cols="12">
            <v-row no-gutters>
            <v-col cols="10">
                  <v-menu ref="menu4" v-model="menu4":close-on-content-click="false" :return-value.sync="tglkuharian"
                    transition="scale-transition" offset-y min-width="290px">
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field v-model="tglkuharian" name="tgl" label="Tanggal" outlined dense required v-bind="attrs" v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="tglkuharian" no-title scrollable>
                      <v-spacer></v-spacer>
                      <v-btn text color="primary" @click="menu4 = false">Cancel</v-btn>
                      <v-btn text color="primary" @click="$refs.menu4.save(tglkuharian)">OK</v-btn>
                    </v-date-picker>
                  </v-menu>
                </v-col>
                <v-col cols="2" class="text-center">
                  <v-btn class="mx-2" fab dark small color="primary" @click="printkuharianan">
                  <v-icon dark> mdi-printer </v-icon>
                </v-btn>
                </v-col>
                <v-col cols="12" class="text-center">
                  <p><b>LAPORAN KEUANGAN HARIAN</b></p>
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
                  <v-menu ref="menu2" v-model="menu2" :close-on-content-click="false" :return-value.sync="tglkubulanan" offset-y max-width="290px" min-width="290px" >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="tglkubulanan" label="Bulan" v-bind="attrs" outlined dense  v-on="on" ></v-text-field>
                  </template>
                  <v-date-picker v-model="tglkubulanan" type="month" no-title scrollable > <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu2 = false" > Cancel </v-btn>
                    <v-btn text color="primary" @click="$refs.menu2.save(tglkubulanan)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
                </v-col>
                <v-col cols="2" class="text-center">
                  <v-btn class="mx-2" fab dark small color="primary" @click="printkubulannan">
                  <v-icon dark> mdi-printer </v-icon>
                </v-btn>
                </v-col>
                <v-col cols="12" class="text-center">
                  <p><b>LAPORAN KEUANGAN BULANAN</b></p>
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
                  <v-menu ref="menu3" v-model="menu3" :close-on-content-click="false" :return-value.sync="tglkutahuanan" offset-y max-width="290px" min-width="290px" >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="tglkutahuanan" label="TAHUN" v-bind="attrs" outlined dense  v-on="on" ></v-text-field>
                  </template>
                  <v-date-picker v-model="tglkutahuanan" type="year" no-title scrollable > <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu3 = false" > Cancel </v-btn>
                    <v-btn text color="primary" @click="$refs.menu3.save(tglkutahuanan)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
                </v-col>
                <v-col cols="2" class="text-center">
                  <v-btn class="mx-2" fab dark small color="primary" @click="printkutahunan">
                  <v-icon dark> mdi-printer </v-icon>
                </v-btn>
                </v-col>
                <v-col cols="12" class="text-center">
                  <p><b>LAPORAN KEUANGAN TAHUNAN</b></p>
                </v-col>
                </v-row>
                </v-col>
          </v-card>
        </v-col>
    </v-row>
</v-container>
</template>

<script>
  export default {
    data() {
        return ({
            menu: false,
            menu1: false,
            menu2: false,
            menu3: false,
            menu4: false,
            menu5: false,
            tglharian: new Date().toISOString().substr(0, 10),
            tglbulanan: new Date().toISOString().substr(0, 7),
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
      printtahunan(){
            window.open('/cetak/'+this.tgltahuanan+'/laporanloketpendaftarantahunan', "_blank");
      },
      printkuharianan(){
            window.open('/cetak/'+this.tglkuharian+'/laporankeuanganharian', "_blank");
      },
      printkubulanan(){
            window.open('/cetak/'+this.tglkubulanan+'/laporankeuanganbulanan', "_blank");
      },
      printkutahunan(){
            window.open('/cetak/'+this.tglkutahuanan+'/laporankeuangantahunan', "_blank");
      },
    }
  }
</script>