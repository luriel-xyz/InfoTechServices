<?php

namespace App;

use App\DB;

class Hardware
{
  public static function getHardwareComponents($hwcomponent_id = null)
  {
    if ($hwcomponent_id == null) {
      $sql = "SELECT * FROM hardwarecomponent_tbl";
      return DB::all($sql);
    } else {
      $sql = "SELECT * FROM hardwarecomponent_tbl 
							WHERE hwcomponent_id = ?
							LIMIT 1";
      return DB::single($sql, [$hwcomponent_id]);
    }
  }

  /*  Get Hardware Components by Category */
  public static function getHardwareComponentsByCategory($hwcomponent_type)
  {
    $sql = "SELECT * FROM hardwarecomponent_tbl WHERE hwcomponent_type = ?";
    return DB::all($sql, [$hwcomponent_type]);
  }

  /*  Get Hardware Components by Sub Category
			@param hwcomponent_id - Id of the main component
	*/
  public static function getHardwareComponentsBySubCategory($hwcomponent_id)
  {
    $sql = "SELECT * FROM hardwarecomponent_tbl WHERE hwcomponent_category = ?";
    return DB::all($sql, [$hwcomponent_id]);
  }

  /* Add Hardware Component */
  public static function addHardwareComponent($hwcomponent_name, $hwcomponent_type, $hwcomponent_category)
  {
    $sql = "INSERT INTO hardwarecomponent_tbl (hwcomponent_name,hwcomponent_type,hwcomponent_category) 
						VALUES (?,?,?)";
    return DB::insert($sql, [$hwcomponent_name, $hwcomponent_type, $hwcomponent_category]);
  }

  /* Update Hardware Component */
  public static function updateHardwareComponent($hwcomponent_id, $hwcomponent_name, $hwcomponent_type, $hwcomponent_category)
  {
    $sql = "UPDATE hardwarecomponent_tbl 
            SET hwcomponent_name = :hwcomponent_name, 
            hwcomponent_type = :hwcomponent_type, 
            hwcomponent_category = :hwcomponent_category 
            WHERE hwcomponent_id = :hwcomponent_id";

    return DB::insert($sql, [
      ':hwcomponent_name' => $hwcomponent_name,
      ':hwcomponent_type' => $hwcomponent_type,
      ':hwcomponent_category' => $hwcomponent_category,
      ':hwcomponent_id' => $hwcomponent_id
    ]);
  }
}
