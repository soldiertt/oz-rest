<?php

/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 15:38
 */

namespace Arthurius\model;

class Product extends Entity
{

    public static $table = "product";

    public static $SQL_FIND_BY_CATEGORY = <<<'EOD'
        SELECT id, ref, marque, name, description, picture, manche, acier, size, promo, price, piece
        FROM product WHERE type=?
        ORDER BY name desc
EOD;

    public static function findByCategory($category) {
        return self::queryList(self::$SQL_FIND_BY_CATEGORY, [$category]);
    }
}