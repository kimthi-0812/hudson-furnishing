<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add soft deletes to all domain tables if missing
        $tables = [
            'sections','categories','brands','materials','products','product_images','offers','offer_products','reviews','contacts','site_settings','visitor_stats','gallery','users','personal_access_tokens','failed_jobs','media'
        ];

        foreach ($tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $tableObj) {
                    $tableObj->softDeletes();
                });
            }
        }

        // Adjust FK constraints: set RESTRICT on delete (no cascade deletes)
        // Note: portable approach is to drop and recreate constraints where supported (MySQL). SQLite ignores named FKs in this context.
        if (DB::getDriverName() === 'mysql') {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropForeign(['section_id']);
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict');
            });

            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['section_id']);
                $table->dropForeign(['category_id']);
                $table->dropForeign(['brand_id']);
                $table->dropForeign(['material_id']);
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict');
                $table->foreign('material_id')->references('id')->on('materials')->onDelete('restrict');
            });

            Schema::table('product_images', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            });

            Schema::table('reviews', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            });

            Schema::table('offer_products', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->dropForeign(['offer_id']);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
                $table->foreign('offer_id')->references('id')->on('offers')->onDelete('restrict');
            });
        }
    }

    public function down(): void
    {
        // Revert FK deletes back to cascade to match original migrations (best effort)
        if (DB::getDriverName() === 'mysql') {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropForeign(['section_id']);
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            });

            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['section_id']);
                $table->dropForeign(['category_id']);
                $table->dropForeign(['brand_id']);
                $table->dropForeign(['material_id']);
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
                $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            });

            Schema::table('product_images', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });

            Schema::table('reviews', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });

            Schema::table('offer_products', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->dropForeign(['offer_id']);
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
            });
        }

        // Remove soft deletes columns (best effort)
        $tables = [
            'sections','categories','brands','materials','products','product_images','offers','offer_products','reviews','contacts','site_settings','visitor_stats','gallery','users','personal_access_tokens','failed_jobs','media'
        ];
        foreach ($tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $tableObj) {
                    $tableObj->dropSoftDeletes();
                });
            }
        }
    }
};


