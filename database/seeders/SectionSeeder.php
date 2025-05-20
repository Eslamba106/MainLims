<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dashboards 1 - 2
        Section::updateOrCreate(['id' => 1], ['name' => 'admin_general_dashboard', 'caption' => 'admin_general_dashboard']);
        Section::updateOrCreate(['id' => 2], ['name' => 'admin_general_dashboard_show', 'section_group_id' => 1, 'caption' => "general_dashboard_page"]);

        // Roles 3 - 7
        Section::updateOrCreate(['id' => 3], ['name' => 'admin_roles', 'caption' => 'admin_roles']);
        Section::updateOrCreate(['id' => 4], ['name' => 'show_admin_roles', 'section_group_id' => 3, 'caption' => 'show_admin_roles']);
        Section::updateOrCreate(['id' => 5], ['name' => 'create_admin_roles', 'section_group_id' => 3, 'caption' => 'create_admin_roles']);
        Section::updateOrCreate(['id' => 6], ['name' => 'edit_admin_roles', 'section_group_id' => 3, 'caption' => 'edit_admin_roles']);
        Section::updateOrCreate(['id' => 7], ['name' => 'update_admin_roles', 'section_group_id' => 3, 'caption' => 'update_admin_roles']);
        Section::updateOrCreate(['id' => 8], ['name' => 'delete_admin_roles', 'section_group_id' => 3, 'caption' => 'delete_admin_roles']);

        // Users Management 9 - 15

        Section::updateOrCreate(['id' => 9], ['name' => 'user_management', 'caption' => 'user_management']);
        Section::updateOrCreate(['id' => 10], ['name' => 'all_users', 'section_group_id' => 9, 'caption' => 'show_all_users']);
        Section::updateOrCreate(['id' => 11], ['name' => 'change_users_role', 'section_group_id' => 9, 'caption' => 'change_users_role']);
        Section::updateOrCreate(['id' => 12], ['name' => 'change_users_status', 'section_group_id' => 9, 'caption' => 'change_users_status']);
        Section::updateOrCreate(['id' => 13], ['name' => 'delete_user', 'section_group_id' => 9, 'caption' => 'delete_user']);
        Section::updateOrCreate(['id' => 14], ['name' => 'edit_user', 'section_group_id' => 9, 'caption' => 'edit_user']);
        Section::updateOrCreate(['id' => 15], ['name' => 'create_user', 'section_group_id' => 9, 'caption' => 'create_user']);
        
    
        // Test Method Management 16 - 22
        Section::updateOrCreate(['id' => 16], ['name' => 'test_method_management', 'caption' => 'test_method_management']);
        Section::updateOrCreate(['id' => 17], ['name' => 'all_test_methods', 'section_group_id' => 16, 'caption' => 'show_all_test_methods']);
        Section::updateOrCreate(['id' => 18], ['name' => 'create_test_method', 'section_group_id' => 16, 'caption' => 'create_test_method']);
        Section::updateOrCreate(['id' => 19], ['name' => 'change_test_methods_role', 'section_group_id' => 16, 'caption' => 'change_test_methods_role']);
        Section::updateOrCreate(['id' => 20], ['name' => 'change_test_methods_status', 'section_group_id' => 16, 'caption' => 'change_test_methods_status']);
        Section::updateOrCreate(['id' => 21], ['name' => 'delete_test_method', 'section_group_id' => 16, 'caption' => 'delete_test_method']);
        Section::updateOrCreate(['id' => 22], ['name' => 'edit_test_method', 'section_group_id' => 16, 'caption' => 'edit_test_method']);
        
    
    
        // Test Method Management 23 - 29
        Section::updateOrCreate(['id' => 23], ['name' => 'unit_management', 'caption' => 'unit_management']);
        Section::updateOrCreate(['id' => 24], ['name' => 'change_units_role', 'section_group_id' => 23, 'caption' => 'change_units_role']);
        Section::updateOrCreate(['id' => 25], ['name' => 'change_units_status', 'section_group_id' => 23, 'caption' => 'change_units_status']);
        Section::updateOrCreate(['id' => 26], ['name' => 'delete_unit', 'section_group_id' => 23, 'caption' => 'delete_unit']);
        Section::updateOrCreate(['id' => 27], ['name' => 'edit_unit', 'section_group_id' => 23, 'caption' => 'edit_unit']);
        Section::updateOrCreate(['id' => 28], ['name' => 'create_unit', 'section_group_id' => 23, 'caption' => 'create_unit']);
        Section::updateOrCreate(['id' => 29], ['name' => 'all_units', 'section_group_id' => 23, 'caption' => 'show_all_units']);
        
    
    
        // Test Method Management 30- 36
        Section::updateOrCreate(['id' => 30], ['name' => 'result_type_management', 'caption' => 'result_type_management']);
        Section::updateOrCreate(['id' => 31], ['name' => 'change_result_types_status', 'section_group_id' => 30, 'caption' => 'change_result_types_status']);
        Section::updateOrCreate(['id' => 32], ['name' => 'delete_result_type', 'section_group_id' => 30, 'caption' => 'delete_result_type']);
        Section::updateOrCreate(['id' => 33], ['name' => 'edit_result_type', 'section_group_id' => 30, 'caption' => 'edit_result_type']);
        Section::updateOrCreate(['id' => 34], ['name' => 'create_result_type', 'section_group_id' => 30, 'caption' => 'create_result_type']);
        Section::updateOrCreate(['id' => 35], ['name' => 'change_result_types_role', 'section_group_id' => 30, 'caption' => 'change_result_types_role']);
        Section::updateOrCreate(['id' => 36], ['name' => 'all_result_types', 'section_group_id' => 30, 'caption' => 'show_all_result_types']);
        
    
    
        // Sample Management 37 - 42  
        Section::updateOrCreate(['id' => 37], ['name' => 'sample_management', 'caption' => 'sample_management']);
        Section::updateOrCreate(['id' => 38], ['name' => 'change_samples_status', 'section_group_id' => 37, 'caption' => 'change_samples_status']);
        Section::updateOrCreate(['id' => 39], ['name' => 'delete_sample', 'section_group_id' => 37, 'caption' => 'delete_sample']);
        Section::updateOrCreate(['id' => 40], ['name' => 'edit_sample', 'section_group_id' => 37, 'caption' => 'edit_sample']);
        Section::updateOrCreate(['id' => 41], ['name' => 'create_sample', 'section_group_id' => 37, 'caption' => 'create_sample']);
        Section::updateOrCreate(['id' => 42], ['name' => 'all_samples', 'section_group_id' => 37, 'caption' => 'show_all_samples']);
        
    
        // Plant Management 43 -  45
        Section::updateOrCreate(['id' => 43], ['name' => 'plant_management', 'caption' => 'plant_management']);
        Section::updateOrCreate(['id' => 44], ['name' => 'change_plants_status', 'section_group_id' => 43, 'caption' => 'change_plants_status']);
        Section::updateOrCreate(['id' => 45], ['name' => 'delete_plant', 'section_group_id' => 43, 'caption' => 'delete_plant']);
        Section::updateOrCreate(['id' => 46], ['name' => 'edit_plant', 'section_group_id' => 43, 'caption' => 'edit_plant']);
        Section::updateOrCreate(['id' => 47], ['name' => 'create_plant', 'section_group_id' => 43, 'caption' => 'create_plant']);
        Section::updateOrCreate(['id' => 48], ['name' => 'all_plants', 'section_group_id' => 43, 'caption' => 'show_all_plants']);
        
    
    }
}
