<?php

/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */

/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use yii\db\Migration;

class <?= $className ?> extends Migration
{
    public function up()
    {
    }

    public function down()
    {
    }
}
