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

     public static $SQL_SELECT_ALL = <<<'EOD'
        SELECT person.id, pnr, firstname, lastname, birthdate, ssin, badge, photo, priv_phone,
            work_phone, medical_examination_date, rescuer, grade.value as grade_value,
            brigade.value as brigade_value
        FROM person INNER JOIN grade ON person.grade_id = grade.id
                    INNER JOIN brigade ON person.brigade_id = brigade.id
EOD;

     public static $SQL_INSERT = <<<'EOD'
        INSERT INTO person (pnr, firstname, lastname, birthdate, ssin, badge, photo, priv_phone,
            work_phone, medical_examination_date, rescuer, grade_id, brigade_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
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
         return self::queryList(self::$SQL_SELECT_ALL);
     }

     public static function find($id) {
         return self::queryOne("SELECT * FROM ".static::$table." WHERE id = ?", [$id]);
     }

     public static function create($person) {
         $rescuerBool = $person['rescuer'] ? 1 : 0;
         // 1. CREATE PERSON
         $id = self::execute(self::$SQL_INSERT, [$person['pnr'], $person['firstname'], $person['lastname'],
             $person['birthdate'], $person['ssin'], $person['badge'], self::optional($person['photo']),
             self::optional($person['priv_phone']), self::optional($person['work_phone']),
             self::optional($person['medical_examnation_date']), self::boolean($person['rescuer']),
             $person['grade'], $person['brigade']]);
         if ($id != null) {
             // 2. CREATE CERTIFICATIONS
             $certifications = $person['certifications'];
             if (count($certifications) > 0) {
                 foreach ($certifications as $certification) {
                     self::execute(self::$SQL_INSERT_CERTIF, [$id, $certification['certification'], $certification['date']]);
                 }
             }
             // 2. CREATE PERSON WORK REGIMES
             $work_regimes = $person['work_regimes'];
             if (count($work_regimes) > 0) {
                 foreach ($work_regimes as $work_regime) {
                     self::execute(self::$SQL_INSERT_WORK_REGIME, [$id, $work_regime['work_regime'], $work_regime['date']]);
                 }
             }
             return $id;
         }
     }

     private static function optional($value) {
         return $value ? $value : null;
     }

     private static function boolean($value) {
         return $value ? 1 : 0;
     }
 }