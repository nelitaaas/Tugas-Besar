<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KPenggajianT extends PenggajianT {

    public static function model($className = __CLASS__) {
        parent::model($className);
    }
	public function searchTabel()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with = 'karyawan';
                $criteria->compare('LOWER(karyawan.nama_karyawan)',strtolower($this->nama_karyawan),true);
		$criteria->compare('penggajian_id',$this->penggajian_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('pengeluarankas_id',$this->pengeluarankas_id);
                $criteria->addBetweenCondition('date(tglpenggajian)',$this->tglAwal, $this->tglAkhir);
		$criteria->compare('bulan',$this->bulan);
		$criteria->compare('tahun',$this->tahun);
		$criteria->compare('nopenggajian',$this->nopenggajian,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('mengetahui',$this->mengetahui,true);
		$criteria->compare('menyetujui',$this->menyetujui,true);
		$criteria->compare('penerimaankotor',$this->penerimaankotor);
		$criteria->compare('jmlpotongan',$this->jmlpotongan);
		$criteria->compare('penerimaanbersih',$this->penerimaanbersih);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchPrint()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->with = 'karyawan';
                $criteria->compare('LOWER(karyawan.nama_karyawan)',strtolower($this->nama_karyawan),true);
		$criteria->compare('penggajian_id',$this->penggajian_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('pengeluarankas_id',$this->pengeluarankas_id);
                $criteria->addBetweenCondition('date(tglpenggajian)',$this->tglAwal, $this->tglAkhir);
		$criteria->compare('bulan',$this->bulan);
		$criteria->compare('tahun',$this->tahun);
		$criteria->compare('nopenggajian',$this->nopenggajian,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('mengetahui',$this->mengetahui,true);
		$criteria->compare('menyetujui',$this->menyetujui,true);
		$criteria->compare('penerimaankotor',$this->penerimaankotor);
		$criteria->compare('jmlpotongan',$this->jmlpotongan);
		$criteria->compare('penerimaanbersih',$this->penerimaanbersih);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false
		));
	}
}

?>
