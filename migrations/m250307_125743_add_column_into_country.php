<?php

use app\models\Country\Country;
use yii\db\Migration;

class m250307_125743_add_column_into_country extends Migration
{
    public function up()
    {
        $this->addColumn('country', 'full_name',
            $this->string(360)->after('name'));

        $countries = Country::find()->all();

        // Заполняем новую колонку Полное название из поля 'name'
        foreach ($countries as $country) {
            $country->full_name = $country->name;
            $country->save();
        }

        $this->alterColumn('country', 'full_name',
            $this->string(360)->notNull()->unique()->comment('Полное название'));
    }

    public function down()
    {
        $this->dropColumn('country', 'full_name');
    }
}
