<?php

class KSuratelektronikR extends SuratelektronikR {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function relations() {
        return array(
            'kabupatenkota'=>array(self::BELONGS_TO, 'KabupatenkotaM', 'kabupatenkota_id'),
            'golongan' => array(self::BELONGS_TO, 'GolonganM', 'golongan_id'),
            'lokasi' => array(self::BELONGS_TO, 'LokasiM', 'lokasi_id'),
            'jabatan' => array(self::BELONGS_TO, 'JabatanM', 'jabatan_id'),
            'pelamar' => array(self::BELONGS_TO, 'PelamarT', 'pelamar_id'),
            'pendidikan' => array(self::BELONGS_TO, 'PendidikanM', 'pendidikan_id'),
            'departement' => array(self::BELONGS_TO, 'DepartementM', 'departement_id'),
            'subdepartement' => array(self::BELONGS_TO, 'SubdepartementM', 'subdepartement_id'),
            'jurusan' => array(self::BELONGS_TO, 'JurusanM', 'jurusan_id'),
            'propinsi' => array(self::BELONGS_TO, 'PropinsiM', 'propinsi_id'),
            'karyawan'=>array(self::BELONGS_TO, 'KaryawanM', 'karyawan_id'),
            'jenissurat'=>array(self::BELONGS_TO, 'JenissuratM', 'jenissurat_id'),
            
        );
    }

    public function attributeLabels() {
        return array(
            'suratelektronik_id' => 'ID Surat Elektronik',
            'jenissurat_id' => 'Jenis Surat',
            'tglsurat'=>'Tgl Surat',
            'urutan'=>'Urutan',
            'nosurat'=>'No Surat',
            'judulsurat'=>'Judul Surat',
            'mengetahui'=>'Mengetahui',
            'jmlprint'=>'Jumlah Print',
        );
    }

    public function search() {
       $criteria=new CDbCriteria;

		$criteria->compare('suratelektronik_id', $this->suratelektronik_id);
                $criteria->compare('jenissurat_id', $this->jenissurat_id);
                $criteria->compare('tglsurat', $this->tglsurat);
                $criteria->compare('urutan', $this->urutan);
                $criteria->compare('nosurat', $this->nosurat);
                $criteria->compare('judulsurat', $this->judulsurat);
                $criteria->compare('mengetahui', $this->mengetahui);
                $criteria->compare('jmlprint', $this->jmlprint);
                
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    
   public function beforeSave(){
            if($this->tglsurat == ''){
                $this->tglsurat = null;
            }
            
            return parent::beforeSave();
        }
}
?>
