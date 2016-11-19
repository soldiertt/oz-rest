<?php
/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 09-10-16
 * Time: 21:40
 */
namespace Oz\model;

 class Person extends Entity {

     public static $table = "person";

     public static $SQL_INSERT = <<<'EOD'
        INSERT INTO person (pnr, firstname, lastname, birthdate, ssin, badge, photo, priv_phone,
            work_phone, medical_examination_date, rescuer, grade_id, brigade_id, security_function_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
EOD;

     public static $SQL_INSERT_CERTIF = <<<'EOD'
        INSERT INTO person_certification (person_id, certification_id, date)
        VALUES (?, ?, ?)
EOD;

     public static $SQL_INSERT_WORK_REGIME = <<<'EOD'
        INSERT INTO person_work_regime (person_id, work_regime_id, since)
        VALUES (?, ?, ?)
EOD;

     public static function findAll() {
         return self::queryList("SELECT * FROM ".static::$table);
     }

     public static function find($id) {
         return self::queryOne("SELECT * FROM ".static::$table." WHERE id = ?", [$id]);
     }

     public static function create($person) {
         $rescuerBool = $person['rescuer'] ? 1 : 0;
         // 1. CREATE PERSON
         $id = self::execute(self::$SQL_INSERT, [$person['pnr'], $person['firstname'], $person['lastname'],
            $person['birthdate'], $person['ssin'], $person['badge'], $person['photo'], $person['priv_phone'],
            $person['work_phone'], $person['medical_examination_date'], $rescuerBool, $person['grade'],
            $person['brigade'], $person['security_function']]);
         if ($id != null) {
             // 2. CREATE CERTIFICATIONS
             $certifications = $person['certifications'];
             if (count($certifications) > 0) {
                 foreach ($certifications as $certification) {
                     self::execute(self::$SQL_INSERT_CERTIF, [$id, $certification['id'], $certification['date']]);
                 }
             }
             // 2. CREATE PERSON WORK REGIMES
             $work_regimes = $person['work_regimes'];
             if (count($work_regimes) > 0) {
                 foreach ($work_regimes as $work_regime) {
                     self::execute(self::$SQL_INSERT_WORK_REGIME, [$id, $work_regime['id'], $work_regime['since']]);
                 }
             }
             return $id;
         }
     }

 }