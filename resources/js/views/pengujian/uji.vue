<template>
<v-container fluid>
<v-row dense>
  <form @submit.prevent="savePost">
	<v-col cols="12">
	<v-bottom-navigation :value="activeBtn" v-model="activeBtn" color="primary" horizontal >
	    <v-btn><span>Data Kendaraan</span><v-icon>mdi-map-marker</v-icon></v-btn>

	    <v-btn v-show="halamanakses == '1'" @click="posisipos('1')"><span>POS 1</span><v-icon>mdi-map-marker</v-icon></v-btn>

	    <v-btn v-show="halamanakses2 == '1'" @click="posisipos('2')"><span>POS 2</span><v-icon>mdi-map-marker</v-icon></v-btn> 
	  </v-bottom-navigation>
	</v-col>
	<v-col cols="12">
	<v-card class="mx-auto yellow lighten-3 black--text" tile>
		<v-row no-gutters>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>No Kendaraan</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.noregistrasikendaraan }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>No Uji</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.nouji }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>Th Pembuatan</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.thpembuatan }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>Merek</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.merek }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>JBB</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.jbb }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>Jenis Kendaraan</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.jenis }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>No Mesin</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.nomesin }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		<v-col cols="4">
		<v-list-item two-line>
	      <v-list-item-content>
	        <v-list-item-title>No Rangka</v-list-item-title>
	        <v-list-item-subtitle>{{ datakendaraan.norangka }}</v-list-item-subtitle>
	      </v-list-item-content>
	    </v-list-item>
		</v-col>
		</v-row>
    </v-card>
	</v-col>
	<v-col cols="12" v-if="activeBtn === 0">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>FOTO KENDARAAN</v-card-title>
	<v-card-subtitle>
		<v-row>
			<v-col cols="2" class="text-center">
            	<v-btn class="mx-2" fab dark small color="primary" @click="fotokendaraan">
					<v-icon dark> mdi-folder-upload </v-icon>
				</v-btn>
            </v-col>
		</v-row>
	</v-card-subtitle>
	</v-card-title>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[0]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>PEMERIKSAAN VISUAL KENDARAAN</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="4">
				<v-radio-group v-model="form.huv_nomordankondisirangka">
					<template v-slot:label>
					<div>Nomor dan kondisi rangka kendaraan bermotor</div>
					</template>
					<v-row>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group  v-model="form.huv_nomordantipemotorpenggerak">
					<template v-slot:label>
					<div>Nomor dan tipe motor penggerak</div>
					</template>
					<v-row>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
				<v-radio-group v-model="form.huv_kondisitangkicorongdanpipabahanbakar">
					<template v-slot:label>
					<div>Kondisi tangki bahan bakar, corong pengisi bahan bakar, pipa saluran bahan bakar</div>
					</template>
					<v-row>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
				<v-radio-group v-model="form.huv_kondisikacaspion">
					<template v-slot:label>
					<div>Kondisi kaca spion</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_kondisispakbor">
					<template v-slot:label>
					<div>Kondisi spakbor</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>

			<v-col cols="12" sm="6" md="4">
				<v-radio-group v-model="form.huv_kondisidanposisipipapembuangan">
					<template v-slot:label>
					<div>Kondisi dan posisi pipa pembuangan</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_ukurandankondisiban">
					<template v-slot:label>
					<div>Ukuran roda dan ban serta kondisi ban</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_kondisisistemsuspensi">
					<template v-slot:label>
					<div>Kondisi sistem suspensi</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_keberadaandankondisiperlengkapan">
					<template v-slot:label>
					<div>Keberadaan dan kondisi perlengkapan kendaraan</div>
					</template>
					<v-row>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_rancanganteknis">
					<template v-slot:label>
					<div>Rancangan teknis Kendaraan sesuai peruntukannya</div>
					</template>
					<v-row>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>

			<v-col cols="12" sm="6" md="4">
				<v-radio-group v-model="form.huv_kondisisistemremutama">
					<template v-slot:label>
					<div>Kondisi sistem rem utama</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_kondisipenutuplampudanalatpantulcahaya">
					<template v-slot:label>
					<div>Kondisi penutup lampu dan alat pemantul cahaya</div>
					</template>
					<v-row>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group  v-model="form.huv_kondisipanelinstrumentdashboard">
					<template v-slot:label>
					<div>Kondisi panel instrumen pada dashboard Kendaraan</div>
					</template>
					<v-row >
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.huv_bentukbumper">
					<template v-slot:label>
					<div>Bentuk bumper</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>

		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[1]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>PEMERIKSAAN MANUAL KENDARAAN</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="4">
				<v-radio-group v-model="form.hum_kondisipenerusdaya">
					<template v-slot:label>
					<div>Kondisi penerus daya</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.hum_sudutbebaskemudi">
					<template v-slot:label>
					<div>Sudut bebas kemudi</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
				<v-radio-group v-model="form.hum_kondisiremparkir">
					<template v-slot:label>
					<div>Kondisi rem parkir</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
				<v-radio-group v-model="form.hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus">
					<template v-slot:label>
					<div>Ukuran tempat duduk dan bagian dalam Kendaraan</div>
					</template>
					<v-row >
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>

			<v-col cols="12" sm="6" md="4">
				<v-radio-group  v-model="form.hum_fungsilampudanalatpantulcahaya">
					<template v-slot:label>
					<div>Fungsi lampu dan alat pemantul cahaya</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.hum_fungsipenghapuskaca">
					<template v-slot:label>
					<div>Fungsi penghapus kaca</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.hum_tingkatkegelapankaca">
					<template v-slot:label>
					<div>Tingkat kegelapan kaca</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>

			<v-col cols="12" sm="6" md="4">
				<v-radio-group  v-model="form.hum_fungsiklakson">
					<template v-slot:label>
					<div>Fungsi klakson</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group  v-model="form.hum_kondisidanfungsisabukkeselamatan">
					<template v-slot:label>
					<div>Kondisi dan fungsi sabuk keselamatan</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>

				<v-radio-group v-model="form.hum_ukurankendaraan">
					<template v-slot:label>
					<div>Ukuran kendaraan</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="1">
						<template v-slot:label>
							<div>Ya</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="3">
					<v-radio value="0">
						<template v-slot:label>
							<div>Tidak</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[11]">
	<v-card class="mx-auto yellow lighten-3">
	<v-card-title>Dimensi Kendaraan</v-card-title>
	<v-card-subtitle>
	<v-row>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Panjang Kendaraan" name="panjangkendaraan" v-model="form.panjangkendaraan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Lebar Kendaraan" name="lebarkendaraan" v-model="form.lebarkendaraan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Tinggi Kendaraan (mm)" name="tinggikendaraan" v-model="form.tinggikendaraan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Rear Over Hang (mm)" name="julurbelakang" v-model="form.julurbelakang" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Front Over Hang (mm)" name="julurdepan" v-model="form.julurdepan" type="number"  outlined dense required></v-text-field>
    	</v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Ground Clearance (mm)" name="groundclearance" v-model="form.groundclearance" type="number"  outlined dense required></v-text-field>
    	</v-col>
	</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[12]">
    <v-card class="mx-auto yellow lighten-3">
    <v-card-title>Dimensi Bak Mutan</v-card-title>
    <v-card-subtitle>
    <v-row>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Panjang (mm)" name="panjangkendaraan" v-model="form.panjangbakatautangki" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Lebar " name="lebarkendaraan" v-model="form.lebarbakatautangki" type="number"  outlined dense required></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Tinggi (mm)" name="tinggikendaraan" v-model="form.tinggibakatautangki" type="number"  outlined dense required></v-text-field>
        </v-col>
    </v-row>
    </v-card-subtitle>
    </v-card>
    </v-col>

    <v-col cols="12" v-if="activeBtn === itemuji[13]">
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

	<v-col cols="12" v-if="activeBtn === itemuji[2]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>EMISI GAS BUANG</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="4" v-if="datakendaraan.bahanbakar === 'Solar' ">
				<v-text-field v-model="form.alatuji_emisiasapbahanbakarsolar" type="number" outlined label="Asap" suffix="%" :rules="rules.asap"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="4" v-if="datakendaraan.bahanbakar != 'Solar' ">
				<v-text-field v-model="form.alatuji_emisicobahanbakarbensin" type="number" outlined label="CO" suffix="%" :rules="rules.emisico"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="4" v-if="datakendaraan.bahanbakar != 'Solar' ">
				<v-text-field v-model="form.alatuji_emisihcbahanbakarbensin" type="number" outlined label="HC" suffix="Ppm" :rules="rules.emisihc"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[3]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>TINGKAT SUARA KLAKSON</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="4">
				<v-text-field v-model="form.alatuji_tingkatkebisingan" type="number" outlined suffix="dB(desibel)" :rules="rules.klaskson"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[4]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>BERAT SUMBU</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.bsumbu1" outlined label="S1" suffix="Kg"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.bsumbu2" outlined label="S2" suffix="Kg"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.bsumbu3" outlined label="S3" suffix="Kg"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.bsumbu4" outlined label="S4" suffix="Kg"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
            
            <v-row>
                <v-col cols="9">
                <v-text-field label="Berat Kosong (Kg)" name="beratkosong" v-model="form.beratkosong" type="number"  outlined dense required></v-text-field>
                </v-col>
                <v-col cols="3">
                <v-btn class="mx-2" fab dark small color="primary" @click="getbk()" ><v-icon dark> mdi-calculator-variant-outline </v-icon></v-btn>
                </v-col>
            </v-row>
        </v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>
	
	<v-col cols="12" v-if="activeBtn === itemuji[5]">
	<v-card class="mx-auto yellow lighten-3">
	<v-card-title>Daya Angkut, Jumlah Berat</v-card-title>
	<v-card-subtitle>
	<v-row>
		<v-col cols="12" sm="6" md="3">
          <v-text-field label="JBI (Kg)" name="jbi" v-model="form.jbi" type="number"  outlined dense required :rules="rules.jbi"></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
          <v-text-field label="JBKI (Kg)" name="jbki" v-model="form.jbki" type="number"  outlined dense required :rules="rules.jbki"></v-text-field>
        </v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="Daya Angkut Orang (orang)" name="dayaangkutorang" v-model="form.dayaangkutorang" type="number" outlined dense required :rules="rules.dayaangkutorang"></v-text-field>
        </v-col>
    	<v-col cols="12" sm="6" md="3">
    		<v-text-field label="Daya Angkut Barang (Kg)" name="dayaangkutbarang" v-model="form.dayaangkutbarang" type="number"  outlined dense required :rules="rules.dayaangkutbarang"></v-text-field>
    	</v-col>
        <v-col cols="12" sm="6" md="3">
            <v-text-field label="MST (Kg)" name="mst" v-model="form.mst" type="number"  outlined dense required :rules="rules.mst"></v-text-field>
        </v-col>

	</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[5]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>KEMAMPUAN REM UTAMA</v-card-title>
	<v-card-subtitle>
		Gaya Rem Kanan
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkanans1" outlined label="S1" ></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="numbe2" v-model="form.gayaremkanans2" outlined label="S2" ></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkanans3" outlined label="S3" ></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkanans4" outlined label="S4" ></v-text-field>
			</v-col>
		</v-row>
		Gaya Rem Kiri
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkiris1" outlined label="S1" ></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkiris2" outlined label="S2" ></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkiris3" outlined label="S3" ></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field type="number" v-model="form.gayaremkiris4" outlined label="S4" ></v-text-field>
			</v-col>
		</v-row>
		<v-row no-gutters >
			<v-col cols="12" sm="12" md="12">
				<v-row>
				<v-col cols="5">
				<v-text-field v-model="form.alatuji_remutamatotalgayapengereman" type="number" outlined label="Total Gaya Rem Utama" suffix="Kg"></v-text-field>
				</v-col>
				<v-col cols="5">
				<v-text-field v-model="form.effisiensirem" type="number" outlined label="Effisiensi Gaya Rem Utama" suffix="%"></v-text-field>
				</v-col>
				<v-col cols="2">
				<v-btn class="mx-2" fab dark small color="primary" @click="counteffisensirem()" ><v-icon dark> mdi-calculator-variant-outline </v-icon></v-btn>
				</v-col>
				</v-row>
			</v-col>
		</v-row>
		Penyimpangan Rem
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_remutamaselisihgayapengeremanrodakirikanan1" type="number" outlined label="S1" suffix="%"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_remutamaselisihgayapengeremanrodakirikanan2" type="number" outlined label="S2" suffix="%"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_remutamaselisihgayapengeremanrodakirikanan3" type="number" outlined label="S3" suffix="%"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_remutamaselisihgayapengeremanrodakirikanan4" type="number" outlined label="S4" suffix="%"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[6]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>KEMAMPUAN REM PARKIR</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_remparkirtangan" type="number" outlined label="Tangan" suffix="%" :rules="remparkirtangan"></v-text-field>
			</v-col>
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_remparkirkaki" type="number" outlined label="kaki" suffix="%" :rules="remparkirkaki"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[7]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>KINCUP RODA DEPAN</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_kincuprodadepan" type="number" outlined label="S1" suffix="mm" :rules="rules.kincuproda"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[8]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>KEMAMPUAN PANCAR dan ARAH SINAR LAMPU UTAMA</v-card-title>
	<v-card-subtitle>
		Intensitas
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_lampuutamakekuatanpancarlampukanan" type="number" outlined label="Kanan" suffix="cd" :rules="rules.kekuatanpancarlampukanan"></v-text-field>
			</v-col>

			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_lampuutamakekuatanpancarlampukiri" type="number" outlined label="Kiri" suffix="cd" :rules="rules.kekuatanpancarlampukiri"></v-text-field>
			</v-col>
		</v-row>
		Arah
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-bind:class="{'text-red': text.alatuji_lampuutamapenyimpanganlampukanan}" v-model="form.alatuji_lampuutamapenyimpanganlampukanan" type="number" outlined label="Kanan" suffix="degree" :rules="rules.penyimpanganlampukanan" ></v-text-field>
			</v-col>

			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_lampuutamapenyimpanganlampukiri" type="number" outlined label="Kiri" suffix="degree" :rules="rules.penyimpanganlampukiri"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[9]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>AKURASI PENUNJUK KECEPATAN/SPEEDOMETER</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_penunjukkecepatan" type="number" outlined  suffix="Km/Jam" :rules="rules.speed"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12" v-if="activeBtn === itemuji[10]">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>KEDALAMAN ALUR BAN</v-card-title>
	<v-card-subtitle>
		<v-row no-gutters >
			<v-col cols="12" sm="6" md="3">
				<v-text-field v-model="form.alatuji_kedalamanalurban" type="number" outlined suffix="mm" :rules="rules.alurban"></v-text-field>
			</v-col>
		</v-row>
	</v-card-subtitle>
	</v-card>
	</v-col>

	<v-col cols="12">
	<v-card class="mx-auto yellow lighten-3 black--text">
	<v-card-title>HASIL PENGUJIAN</v-card-title>
	<v-card-subtitle>
		<v-row v-if="activeBtn == '1' ">
			<v-col cols="12" sm="6" md="4">
				<v-radio-group v-model="form.pos1">
					<template v-slot:label>
					<div>Keterangan Hasil Pengujian POS 1</div>
					</template>
					<v-row >
					<v-col cols="12" sm="6" md="6">
					<v-radio value="1">
						<template v-slot:label>
							<div>Lulus</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="6">
					<v-radio value="2">
						<template v-slot:label>
							<div>Tidak Lulus </div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>
			<v-col cols="12" sm="6" md="4">
				<v-textarea auto-grow row="4" v-model="form.catatanpos1"  row-height="20" name="alamat" label="Catatan Hasil Pengujian" outlined dense clearable>{{ form.catatanpos1 }}</v-textarea>
			</v-col>
		</v-row>
		<v-row v-if="activeBtn == '2' ">
			<v-col cols="12" sm="6" md="4">
				<v-radio-group v-model="form.pos2">
					<template v-slot:label>
					<div>Keterangan Hasil Pengujian POS 2</div>
					</template>
					<v-row no-gutters>
					<v-col cols="12" sm="6" md="6">
					<v-radio value="1">
						<template v-slot:label>
							<div>Lulus</div>
						</template>
					</v-radio>
					</v-col>
					<v-col cols="12" sm="6" md="6">
					<v-radio value="2">
						<template v-slot:label>
							<div>Tidak Lulus</div>
						</template>
					</v-radio>
					</v-col>
					</v-row>
				</v-radio-group>
			</v-col>
			<v-col cols="12" sm="6" md="4">
				<v-textarea auto-grow row="4" v-model="form.catatanpos2"  row-height="20" name="alamat" label="Catatan Hasil Pengujian" outlined dense clearable></v-textarea>
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
</v-row>
</v-container>
</template>
<script>
  export default {
    data () {
      return {
        radios: 'Duckduckgo',
        rules: {
          asap : [
          	val => (val <= 70 && this.datakendaraan.thpembuatan < 2010 && this.datakendaraan.jbb <= 3500) || (val <= 40 && this.datakendaraan.thpembuatan >= 2010 && this.datakendaraan.jbb <= 3500) || (val <= 70 && this.datakendaraan.thpembuatan < 2010 && this.datakendaraan.jbb > 3500) || (val <= 50 && this.datakendaraan.thpembuatan >= 2010 && this.datakendaraan.jbb > 3500),
          ],
          emisico : [
          	val => (val <= 4.5 && this.datakendaraan.thpembuatan < 2007) || (val <= 1.5 && this.datakendaraan.thpembuatan >= 2007),
          ],
          emisihc : [
          	val => (val <= 1200 && this.datakendaraan.thpembuatan < 2007) || (val <= 200 && this.datakendaraan.thpembuatan >= 2007),
          ],
          alurban : [
          	val => val >= 1,
          ],
          klaskson : [
          	val => val >= 83 && val <= 118,
          ],
          remparkirtangan : [
          	val => val <= 12,
          ],
          remparkirkaki : [
          	val => val <= 12,
          ],
          kincuproda: [
          	val => val <= 5,
          ],
          speed: [
          	val => val  >=36 && val  <=46 
          ],
          kekuatanpancarlampukanan: [
            val => val >= 12000 ,
          ],
          kekuatanpancarlampukiri: [
            val => val >= 12000 ,
          ],
          penyimpanganlampukanan: [
            val => val <= 0.34 ,
          ],
          penyimpanganlampukiri: [
            val => val <= 1.09 ,
          ],
          jbi : [
          	val => (val || '').length > 0|| 'This field is required',
          ],
          jbki : [
          	val => (val || '').length > 0 || 'This field is required',
          ],
          dayaangkutorang  : [
          	val => (val || '').length > 0 || 'This field is required',
          ],
          dayaangkutbarang : [
          	val => (val || '').length > 0 || 'This field is required',
          ],
          mst : [
          	val => (val || '').length > 0 || 'This field is required',
          ],
        },
		activeBtn: '',
        datakendaraan: [],
        halamanakses: [],
        halamanakses2: [],
        itemuji: [],
        kondisi:false,
        hasilpos2:'',
        text: {
        		alatuji_lampuutamapenyimpanganlampukanan:false,
            },
        form: new Form({
                huv_nomordankondisirangka: '1',
                huv_nomordantipemotorpenggerak: '1',
                huv_kondisitangkicorongdanpipabahanbakar: '1',
                huv_kondisiconverterkit: '1',
                huv_kondisidanposisipipapembuangan: '1',
                huv_ukurandankondisiban: '1',
                huv_kondisisistemsuspensi: '1',
                huv_kondisisistemremutama: '1',
                huv_kondisipenutuplampudanalatpantulcahaya: '1',
                huv_kondisipanelinstrumentdashboard: '1',
                huv_kondisikacaspion: '1',
                huv_keberadaandankondisiperlengkapan: '1',
                huv_kondisispakbor: '1',
                huv_bentukbumper: '1',
                huv_rancanganteknis: '1',
                huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus: '1',
                huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup:'1',
                hum_kondisipenerusdaya:'1',
                hum_sudutbebaskemudi:'1',
                hum_kondisiremparkir:'1',
                hum_fungsilampudanalatpantulcahaya:'1',
                hum_fungsipenghapuskaca:'1',
                hum_tingkatkegelapankaca:'1',
                hum_fungsiklakson:'1',
                hum_kondisidanfungsisabukkeselamatan:'1',
                hum_ukurankendaraan:'1',
                hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus:'1',
                alatuji_emisiasapbahanbakarsolar:'0',
                alatuji_emisicobahanbakarbensin:'0',
                alatuji_emisihcbahanbakarbensin:'0',
                alatuji_remutamatotalgayapengereman:'0',
                alatuji_remutamaselisihgayapengeremanrodakirikanan1:'0',
                alatuji_remutamaselisihgayapengeremanrodakirikanan2:'0',
                alatuji_remutamaselisihgayapengeremanrodakirikanan3:'0',
                alatuji_remutamaselisihgayapengeremanrodakirikanan4:'0',
                alatuji_remparkirtangan:'0',
                alatuji_remparkirkaki:'0',
                alatuji_kincuprodadepan:'0',
                alatuji_tingkatkebisingan:'0',
                alatuji_lampuutamakekuatanpancarlampukanan:'0',
                alatuji_lampuutamakekuatanpancarlampukiri:'0',
                alatuji_lampuutamapenyimpanganlampukanan:'0',
                alatuji_lampuutamapenyimpanganlampukiri:'0',
                alatuji_penunjukkecepatan:'0',
                alatuji_kedalamanalurban:'0',
                mst: '0',
                jbi: '0',
                jbki: '0',
                dayaangkutbarang : '0',
                dayaangkutorang: '0',
                panjangkendaraan: '0',
                lebarkendaraan: '0',
                tinggikendaraan: '0',
                julurbelakang: '0',
                julurdepan: '0',
                groundclearance: '0',
                bsumbu1:'0',
                bsumbu2:'0',
                bsumbu2:'0',
                bsumbu4:'0',
                beratkosong:'0',
                panjangbakatautangki:'0',
                lebarbakatautangki:'0',
                tinggibakatautangki:'0',
                jaraksumbu1_2: '0',
                jaraksumbu2_3: '0',
                jaraksumbu3_4: '0',
                p: '0',
                q:  '0',
                gayaremkiris1:'0',
                gayaremkiris2:'0',
                gayaremkiris3:'0',
                gayaremkiris4:'0',
                gayaremkanans1:'0',
                gayaremkanans2:'0',
                gayaremkanans3:'0',
                gayaremkanans4:'0',
                effisiensirem:'0',
                posisipos:'',
                pos1:'',
                pos2:'',
                catatanpos1:'',
                catatanpos2:'',
                petugaspos1:'',
                petugaspos2:'',
            })
      }
    },
    methods: {
    	goBack() {
          window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        },
        fotokendaraan() {
            window.open('/upload/'+this.$route.params.id+'/fotokendaraan/', "_blank");
        },
        savePost() {
        },
        getbk(){
            if(this.form.beratsumbu4 > 0){
            this.form.beratkosong = parseInt(this.form.bsumbu1)+parseInt(this.form.bsumbu2)+parseInt(this.form.bsumbu3)+parseInt(this.form.bsumbu4)
            }else if(this.form.bsumbu13 > 0){
                this.form.beratkosong = parseInt(this.form.bsumbu1)+parseInt(this.form.bsumbu2)+parseInt(this.form.bsumbu3)
            }else if(this.form.bsumbu2 > 0){
                this.form.beratkosong = parseInt(this.form.bsumbu1)+parseInt(this.form.bsumbu2)
            }else if(this.form.bsumbu1 > 0){
                this.form.beratkosong = parseInt(this.form.beratsumbu1)
            }
            
        },
        posisipos(posisi){
        	this.form.posisipos = posisi; 
        },
        fetchPost(id) {
            axios({
                    url: '/api/uji/'+id,
                    method: "get"
                })
                .then((result) => {
                    this.datakendaraan= result.data.kendaraan
                    if(result.data.kendaraan.pendaftaran_id){
                    this.form.huv_nomordankondisirangka = result.data.kendaraan.huv_nomordankondisirangka
                    this.form.huv_nomordantipemotorpenggerak = result.data.kendaraan.huv_nomordantipemotorpenggerak
                    this.form.huv_kondisitangkicorongdanpipabahanbakar = result.data.kendaraan.huv_kondisitangkicorongdanpipabahanbakar
                    this.form.huv_kondisiconverterkit = result.data.kendaraan.huv_kondisiconverterkit
                    this.form.huv_kondisidanposisipipapembuangan = result.data.kendaraan.huv_kondisidanposisipipapembuangan
                    this.form.huv_ukurandankondisiban = result.data.kendaraan.huv_ukurandankondisiban
                    this.form.huv_kondisisistemsuspensi = result.data.kendaraan.huv_kondisisistemsuspensi
                    this.form.huv_kondisisistemremutama = result.data.kendaraan.huv_kondisisistemremutama
                    this.form.huv_kondisipenutuplampudanalatpantulcahaya = result.data.kendaraan.huv_kondisipenutuplampudanalatpantulcahaya
                    this.form.huv_kondisipanelinstrumentdashboard = result.data.kendaraan.huv_kondisipanelinstrumentdashboard
                    this.form.huv_kondisikacaspion = result.data.kendaraan.huv_kondisikacaspion
                    this.form.huv_kondisispakbor = result.data.kendaraan.huv_kondisispakbor
                    this.form.huv_bentukbumper = result.data.kendaraan.huv_bentukbumper
                    this.form.huv_keberadaandankondisiperlengkapan = result.data.kendaraan.huv_keberadaandankondisiperlengkapan
                    this.form.huv_rancanganteknis = result.data.kendaraan.huv_rancanganteknis
                    this.form.huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus = result.data.kendaraan.huv_keberadaandankondisifasilitastanggapdaruratuntukmobilbus
                    this.form.huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup = result.data.kendaraan.huv_kondisibadankacaengseltempatdudukmbarangbakmuatantertutup
                    this.form.hum_kondisipenerusdaya = result.data.kendaraan.hum_kondisipenerusdaya
                    this.form.hum_sudutbebaskemudi = result.data.kendaraan.hum_sudutbebaskemudi
                    this.form.hum_kondisiremparkir = result.data.kendaraan.hum_kondisiremparkir
                    this.form.hum_fungsilampudanalatpantulcahaya = result.data.kendaraan.hum_fungsilampudanalatpantulcahaya
                    this.form.hum_fungsipenghapuskaca = result.data.kendaraan.hum_fungsipenghapuskaca
                    this.form.hum_tingkatkegelapankaca = result.data.kendaraan.hum_tingkatkegelapankaca
                    this.form.hum_fungsiklakson = result.data.kendaraan.hum_fungsiklakson
                    this.form.hum_kondisidanfungsisabukkeselamatan = result.data.kendaraan.hum_kondisidanfungsisabukkeselamatan
                    this.form.hum_ukurankendaraan = result.data.kendaraan.hum_ukurankendaraan
                    this.form.hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus = result.data.kendaraan.hum_ukurantempatdudukdanbagiandalamkendaraanuntukmobilbus
                    this.form.alatuji_emisiasapbahanbakarsolar = result.data.kendaraan.alatuji_emisiasapbahanbakarsolar
                    this.form.alatuji_emisicobahanbakarbensin = result.data.kendaraan.alatuji_emisicobahanbakarbensin
                    this.form.alatuji_emisihcbahanbakarbensin = result.data.kendaraan.alatuji_emisihcbahanbakarbensin
                    this.form.alatuji_remutamatotalgayapengereman = result.data.kendaraan.alatuji_remutamatotalgayapengereman
                    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan1 = result.data.kendaraan.alatuji_remutamaselisihgayapengeremanrodakirikanan1
                    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan2 = result.data.kendaraan.alatuji_remutamaselisihgayapengeremanrodakirikanan2
                    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan3 = result.data.kendaraan.alatuji_remutamaselisihgayapengeremanrodakirikanan3
                    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan4 = result.data.kendaraan.alatuji_remutamaselisihgayapengeremanrodakirikanan4
                    this.form.alatuji_remparkirtangan = result.data.kendaraan.alatuji_remparkirtangan
                    this.form.alatuji_remparkirkaki = result.data.kendaraan.alatuji_remparkirkaki
                    this.form.alatuji_kincuprodadepan = result.data.kendaraan.alatuji_kincuprodadepan
                    this.form.alatuji_tingkatkebisingan = result.data.kendaraan.alatuji_tingkatkebisingan
                    this.form.alatuji_lampuutamakekuatanpancarlampukanan = result.data.kendaraan.alatuji_lampuutamakekuatanpancarlampukanan
                    this.form.alatuji_lampuutamakekuatanpancarlampukiri = result.data.kendaraan.alatuji_lampuutamakekuatanpancarlampukiri
                    this.form.alatuji_lampuutamapenyimpanganlampukanan = result.data.kendaraan.alatuji_lampuutamapenyimpanganlampukanan
                    this.form.alatuji_lampuutamapenyimpanganlampukiri = result.data.kendaraan.alatuji_lampuutamapenyimpanganlampukiri
                    this.form.alatuji_penunjukkecepatan = result.data.kendaraan.alatuji_penunjukkecepatan
                    this.form.alatuji_kedalamanalurban = result.data.kendaraan.alatuji_kedalamanalurban
                    this.form.bsumbu1 = result.data.kendaraan.beratsumbu1
                    this.form.bsumbu2 = result.data.kendaraan.beratsumbu2
                    this.form.bsumbu3 = result.data.kendaraan.beratsumbu3
                    this.form.bsumbu4 = result.data.kendaraan.beratsumbu4
                    this.form.beratkosong = result.data.kendaraan.beratkosong
                    this.form.gayaremkanans1 = result.data.kendaraan.gayaremkanans1
                    this.form.gayaremkanans2 = result.data.kendaraan.gayaremkanans2
                    this.form.gayaremkanans3 = result.data.kendaraan.gayaremkanans3
                    this.form.gayaremkanans4 = result.data.kendaraan.gayaremkanans4
                    this.form.gayaremkiris1 = result.data.kendaraan.gayaremkiris1
                    this.form.gayaremkiris2 = result.data.kendaraan.gayaremkiris2
                    this.form.gayaremkiris3 = result.data.kendaraan.gayaremkiris3
                    this.form.gayaremkiris4 = result.data.kendaraan.gayaremkiris4
                    }
                    
                    this.form.dayaangkutbarang = result.data.kendaraan.dayaangkutbarang
                    this.form.dayaangkutorang = result.data.kendaraan.dayaangkutorang
                    this.form.mst = result.data.kendaraan.mst
                    this.form.jbi = result.data.kendaraan.jbi
                    this.form.jbki = result.data.kendaraan.jbki
                    this.form.panjangkendaraan = result.data.kendaraan.panjangkendaraan
                    this.form.lebarkendaraan = result.data.kendaraan.lebarkendaraan
                    this.form.tinggikendaraan = result.data.kendaraan.tinggikendaraan
                    this.form.julurbelakang = result.data.kendaraan.julurbelakang
                    this.form.julurdepan	= result.data.kendaraan.julurdepan
                    this.form.groundclearance = result.data.kendaraan.groundclearance
                    this.form.panjangbakatautangki = result.data.kendaraan.panjangbakatautangki
                    this.form.lebarbakatautangki = result.data.kendaraan.lebarbakatautangki
                    this.form.tinggibakatautangki = result.data.kendaraan.tinggibakatautangki
                    this.form.jaraksumbu1_2 = result.data.kendaraan.jaraksumbu1_2
                    this.form.jaraksumbu2_3 = result.data.kendaraan.jaraksumbu2_3
                    this.form.jaraksumbu3_4 = result.data.kendaraan.jaraksumbu3_4
                    this.form.q = result.data.kendaraan.q
                    this.form.p = result.data.kendaraan.p
                    this.form.pos1 = result.data.kendaraan.pos1.toString()
                    this.form.pos2 = result.data.kendaraan.pos2.toString()
                    this.form.catatanpos1 = result.data.kendaraan.catatanpos1
                    this.form.catatanpos2 = result.data.kendaraan.catatanpos2
                    
                    
                }).catch((err) => {

                });
        },
        initialize() {
            axios({
                    url: '/api/itemujipos/',
                    method: "get"
                })
                .then((result) => {
                    this.itemuji= result.data.items
                }).catch((err) => {

                });
            var id = JSON.parse(localStorage.getItem("user"));
            this.form.petugaspos1 = id.id
            this.form.petugaspos2 = id.id
            
            axios({
                    url: '/api/cekakses1/'+id.id,
                    method: "get",
                })
                .then((result) => {
                    this.halamanakses = result.data.halamanakses
					if(this.halamanakses === 1){
						this.form.posisipos = '1'
						
						}
                }).catch((err) => {

                });
            axios({
                    url: '/api/cekakses2/'+id.id,
                    method: "get",
                })
                .then((result) => {
                    this.halamanakses2 = result.data.halamanakses
					if(this.halamanakses === 1){
						this.form.posisipos = '1'
						this.activeBtn = 1
						}
					else if(this.halamanakses2 === 1){
						this.form.posisipos = '2'
						this.activeBtn = 2
					}
                }).catch((err) => {

                });
        },
        editPost(id) {
            this.form.patch('/api/uji/edit/' + id)
                .then((result) => {
                    Swal.fire({
                        type: 'success',
                        title: 'saved',
                        showConfirmButton: false,
                        timer: 500,
                    })
                    console.log(this.form);
                   this.$router.push('/uji/pendaftarans')
                }).catch((err) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Ooops',
                        text: err
                    })
                });
        },
        counteffisensirem(){
        	var s1= this.form.gayaremkiris1;
		    var s2= this.form.gayaremkiris2;
		    var s3= this.form.gayaremkiris3;
		    var s4= this.form.gayaremkiris4;
		    var s5= this.form.gayaremkanans1;
		    var s6= this.form.gayaremkanans2;
		    var s7= this.form.gayaremkanans3;
		    var s8= this.form.gayaremkanans4;

		    var bs1 = this.form.bsumbu1;
		    var bs2 = this.form.bsumbu2;
		    var bs3 = this.form.bsumbu3;
		    var bs4 = this.form.bsumbu4;

		    var totals  = parseInt(s1)+parseInt(s2)+parseInt(s3)+parseInt(s4)+parseInt(s5)+parseInt(s6)+parseInt(s7)+parseInt(s8);
		    var btotals = parseInt(bs1)+parseInt(bs2)+parseInt(bs3)+parseInt(bs4);

		    var hasil = (totals/btotals)*100;
        	this.form.alatuji_remutamatotalgayapengereman = totals;
        	this.form.effisiensirem = hasil;

        	if (parseInt(s1)>parseInt(s5)) {
		        var hasilS1 = ((parseInt(s1)-parseInt(s5))/parseInt(bs1));
		    }else{
		        var hasilS1 = (parseInt(s5)-parseInt(s1))/parseInt(bs1);
		    }

		    if (parseInt(s2)>parseInt(s6)) {
		        var hasilS2 = (parseInt(s2)-parseInt(s6))/parseInt(bs2);
		    }else{
		        var hasilS2 = (parseInt(s6)-parseInt(s2))/parseInt(bs2);
		    }

		    if (parseInt(s3)>parseInt(s7)) {
		        var hasilS3 = (parseInt(s3)-parseInt(s7))/parseInt(bs3);
		    }else{
		        var hasilS3 = (parseInt(s5)-parseInt(s1))/parseInt(bs3);
		    }

		    if (parseInt(s4)>parseInt(s8)) {
		        var hasilS4 = (parseInt(s4)-parseInt(s8))/parseInt(bs4);
		    }else{
		        var hasilS4 = (parseInt(s8)-parseInt(s4))/parseInt(bs4);
		    }

		    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan1 = (parseFloat(hasilS1)*100).toFixed(2);
		    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan2 = (parseFloat(hasilS2)*100).toFixed(2);
		    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan3 = (parseFloat(hasilS3)*100).toFixed(2);
		    this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan4 = (parseFloat(hasilS4)*100).toFixed(2);

		   	if(this.form.gayaremkiris3 == 0 || this.form.gayaremkanans3 == 0 ){
		   		this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan3 = 0.0;
		   	}

		   	if(this.form.gayaremkiris4 == 0 || this.form.gayaremkanans4 == 0 ){
		   		this.form.alatuji_remutamaselisihgayapengeremanrodakirikanan4 = 0.0;
		   	}
        },
    },
    created() {
        this.initialize()
        },
    mounted() {
    	var id = this.$route.params.id
        if (id) {
            this.fetchPost(id)
        }
    }

  }
</script>
		
<style>
	.text-red input{
			 color: red !important;
		}
</style>