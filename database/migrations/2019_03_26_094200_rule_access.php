<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RuleAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO `villa_citayam`.`usergroups` (`name`, `created_at`, `server_timestamp`) VALUES ('Admin', now(), now());");
        DB::statement("INSERT INTO `villa_citayam`.`usergroups` (`name`, `created_at`, `server_timestamp`) VALUES ('Bendahara Pengeluaran', now(), now());");
        DB::statement("INSERT INTO `villa_citayam`.`usergroups` (`name`, `created_at`, `server_timestamp`) VALUES ('Bendahara Penerimaan', now(), now());");
        DB::statement("INSERT INTO `villa_citayam`.`usergroups` (`name`, `created_at`, `server_timestamp`) VALUES ('Sekretaris', now(), now());");
        DB::statement("INSERT INTO `villa_citayam`.`usergroups` (`name`, `created_at`, `server_timestamp`) VALUES ('Reader', now(), now());");

        $adminGroup = \App\UserGroup::where('name', 'Admin')->first();
        $bendaharaPenerimaanGroup = \App\UserGroup::where('name', 'Bendahara Penerimaan')->first();
        $bendaharaPengeluaranGrop = \App\UserGroup::where('name', 'Bendahara Pengeluaran')->first();
        $sekretarisGroup = \App\UserGroup::where('name', 'Sekretaris')->first();
        $readerGroup = \App\UserGroup::where('name', 'Reader')->first();

        /*
         * Access Menu
         *
         * # Setting
         * ## Block
         * ## House
         * ## Expense Category
         * ## Income Category
         * ## User
         *
         * # Keuangan
         * ## Penerimaan [write,read]
         * ## Pengeluaran [write,read]
         *
         * # Report
         * ## IPL Report
         *
         * # Citizen
         * ## Data Warga [write,read]
         * ## Data Kepala Keluarga [write,read]
         *
         * # In House [write,read]
         * */

        $menuBlock = \App\Menu::create(['menu_name' => 'Block', 'menu_value' => 'block', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuHouse = \App\Menu::create(['menu_name' => 'House', 'menu_value' => 'house', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuExpenseCategory = \App\Menu::create(['menu_name' => 'Expense category', 'menu_value' => 'expense_category', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuCategoryIncome = \App\Menu::create(['menu_name' => 'Income category', 'menu_value' => 'income_category', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuUser = \App\Menu::create(['menu_name' => 'User', 'menu_value' => 'user', 'server_timestamp' => date('Y-m-d H:i:s')]);

        $menuWriteExpense = \App\Menu::create(['menu_name' => 'Pengeluaran', 'menu_value' => 'write_expense', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadExpense = \App\Menu::create(['menu_name' => 'Pengeluaran', 'menu_value' => 'read_expense', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWriteIncome = \App\Menu::create(['menu_name' => 'Penerimaan', 'menu_value' => 'write_income', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadIncome = \App\Menu::create(['menu_name' => 'Penerimaan', 'menu_value' => 'read_income', 'server_timestamp' => date('Y-m-d H:i:s')]);

        $menuReportIPL = \App\Menu::create(['menu_name' => 'Laporan IPL', 'menu_value' => 'report_ipl', 'server_timestamp' => date('Y-m-d H:i:s')]);

        $menuWritePeople = \App\Menu::create(['menu_name' => 'Warga', 'menu_value' => 'write_people', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadPeople = \App\Menu::create(['menu_name' => 'Warga', 'menu_value' => 'read_people', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWritePeopleFamily = \App\Menu::create(['menu_name' => 'Kartu Keluarga', 'menu_value' => 'write_family', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadPeopleFamily = \App\Menu::create(['menu_name' => 'Kartu Keluarga', 'menu_value' => 'read_family', 'server_timestamp' => date('Y-m-d H:i:s')]);

        $menuWriteInHouse = \App\Menu::create(['menu_name' => 'Penghuni', 'menu_value' => 'write_in_house', 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadInHouse = \App\Menu::create(['menu_name' => 'Penghuni', 'menu_value' => 'read_in_house', 'server_timestamp' => date('Y-m-d H:i:s')]);

        /* Admin Access */
        $menuBlock->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuHouse->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuExpenseCategory->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuCategoryIncome->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuUser->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWriteExpense->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadExpense->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWriteIncome->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadIncome->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReportIPL->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWritePeople->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadPeople->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWritePeopleFamily->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadPeopleFamily->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWriteInHouse->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadInHouse->usergroups()->attach($adminGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);

        /* Bendahara Pengeluaran Access */
        $menuWriteExpense->usergroups()->attach($bendaharaPengeluaranGrop->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadExpense->usergroups()->attach($bendaharaPengeluaranGrop->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadIncome->usergroups()->attach($bendaharaPengeluaranGrop->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReportIPL->usergroups()->attach($bendaharaPengeluaranGrop->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadInHouse->usergroups()->attach($bendaharaPengeluaranGrop->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);

        /* Bendahara Penerimaan Access */
        $menuWriteIncome->usergroups()->attach($bendaharaPenerimaanGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadIncome->usergroups()->attach($bendaharaPenerimaanGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadExpense->usergroups()->attach($bendaharaPenerimaanGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReportIPL->usergroups()->attach($bendaharaPenerimaanGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadInHouse->usergroups()->attach($bendaharaPenerimaanGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);

        /* Sekretaris Access */
        $menuWritePeople->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadPeople->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWritePeopleFamily->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadPeopleFamily->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuWriteInHouse->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadIncome->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadExpense->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReportIPL->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadInHouse->usergroups()->attach($sekretarisGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);

        /* Reader Access */
        $menuReadIncome->usergroups()->attach($readerGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadExpense->usergroups()->attach($readerGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReportIPL->usergroups()->attach($readerGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
        $menuReadInHouse->usergroups()->attach($readerGroup->id, ['created_at' => date('Y-m-d H:i:s'), 'server_timestamp' => date('Y-m-d H:i:s')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
