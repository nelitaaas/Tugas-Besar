<?php

class KJenissuratM extends JenissuratM {

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
            
        );
    }

    public function attributeLabels() {
        return array(
            'jenissurat_id'=>'Jenis Surat',
            'jenissurat_nama' =>'Nama Jenis Surat',
            'jenissurat_no' =>' No. Jenis Surat',
            'jenissurat_judul' => 'Judul Jenis Surat',
            'jenissurat_namalain' => 'Alias Jenis Surat',
            'jenissurat_aktif'=>'Jenis Surat Aktif',
        );
    }

    public function search() {
       $criteria=new CDbCriteria;

		$criteria->compare('jenissurat_id', $this->jenissurat_id);
                $criteria->compare('jenissurat_nama', $this->jenissurat_nama);
                $criteria->compare('jenissurat_no', $this->jenissurat_no);
                $criteria->compare('jenissurat_judul', $this->jenissurat_judul);
                $criteria->compare('jenissurat_namalain', $this->jenissurat_namalain);
                $criteria->compare('jenissurat_aktif', $this->jenissurat_aktif);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
    /**
   public function beforeSave(){
            if($this->tgllahir_karyawan == ''){
                $this->tgllahir_karyawan = null;
            }
            if($this->tglditerima == ''){
                $this->tglditerima = null;
            }
            if($this->tglkeluar == ''){
                $this->tglkeluar = null;
            }
           if($this->create_time == ''){
                $this->create_time = null;
            }
            return parent::beforeSave();
        }*/
}
?>
