<?php

class KPresensiT extends PresensiT{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('presensi_id',$this->presensi_id);
		$criteria->compare('statusscan_id',$this->statusscan_id);
		$criteria->compare('karyawan_id',$this->karyawan_id);
		$criteria->compare('statuskehadiran_id',$this->statuskehadiran_id);
                $criteria->addBetweenCondition('tglpresensi',$this->tglAwal, $this->tglAkhir);
//		$criteria->compare('tglpresensi',$this->tglpresensi,true);
		$criteria->compare('no_fingerprint',$this->no_fingerprint,true);
		$criteria->compare('verifikasi',$this->verifikasi);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}