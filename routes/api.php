<?php

use Backstage\Crm\Http\Controllers\Api\ContactController;
use Backstage\Crm\Http\Controllers\Api\ContactMomentController;
use Backstage\Crm\Http\Controllers\Api\DepartmentController;
use Backstage\Crm\Http\Controllers\Api\LeadController;
use Backstage\Crm\Http\Controllers\Api\OrganizationController;
use Backstage\Crm\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/crm')
    ->middleware(['api', 'auth:sanctum'])
    ->group(function () {
        Route::get('ping', fn () => response()->json(['status' => 'ok']))
            ->name('crm.ping');

        Route::prefix('organizations')
            ->group(function () {
                Route::get('search', [OrganizationController::class, 'search'])
                    ->name('crm.organizations.search');

                Route::apiResource('/', OrganizationController::class)
                    ->names([
                        'index' => 'crm.organizations.index',
                        'store' => 'crm.organizations.store',
                        'show' => 'crm.organizations.show',
                        'update' => 'crm.organizations.update',
                        'destroy' => 'crm.organizations.destroy',
                    ])
                    ->parameters(['' => 'organization']);
            });

        Route::prefix('departments')
            ->group(function () {
                Route::get('search', [DepartmentController::class, 'search'])
                    ->name('crm.departments.search');

                Route::apiResource('/', DepartmentController::class)
                    ->names([
                        'index' => 'crm.departments.index',
                        'store' => 'crm.departments.store',
                        'show' => 'crm.departments.show',
                        'update' => 'crm.departments.update',
                        'destroy' => 'crm.departments.destroy',
                    ])
                    ->parameters(['' => 'department']);
            });

        Route::prefix('contacts')
            ->group(function () {
                Route::get('search', [ContactController::class, 'search'])
                    ->name('crm.contacts.search');

                Route::apiResource('/', ContactController::class)
                    ->names([
                        'index' => 'crm.contacts.index',
                        'store' => 'crm.contacts.store',
                        'show' => 'crm.contacts.show',
                        'update' => 'crm.contacts.update',
                        'destroy' => 'crm.contacts.destroy',
                    ])
                    ->parameters(['' => 'contact']);
            });

        Route::prefix('leads')
            ->group(function () {
                Route::get('search', [LeadController::class, 'search'])
                    ->name('crm.leads.search');

                Route::apiResource('/', LeadController::class)
                    ->names([
                        'index' => 'crm.leads.index',
                        'store' => 'crm.leads.store',
                        'show' => 'crm.leads.show',
                        'update' => 'crm.leads.update',
                        'destroy' => 'crm.leads.destroy',
                    ])
                    ->parameters(['' => 'lead']);
            });

        Route::prefix('tags')
            ->group(function () {
                Route::get('search', [TagController::class, 'search'])
                    ->name('crm.tags.search');

                Route::apiResource('/', TagController::class)
                    ->names([
                        'index' => 'crm.tags.index',
                        'store' => 'crm.tags.store',
                        'show' => 'crm.tags.show',
                        'update' => 'crm.tags.update',
                        'destroy' => 'crm.tags.destroy',
                    ])
                    ->parameters(['' => 'tag']);
            });

        Route::prefix('contact-moments')
            ->group(function () {
                Route::post('{contactMoment}/contacts/attach', [ContactMomentController::class, 'attachContacts'])
                    ->name('crm.contact-moments.contacts.attach');

                Route::delete('{contactMoment}/contacts/detach', [ContactMomentController::class, 'detachContacts'])
                    ->name('crm.contact-moments.contacts.detach');

                Route::apiResource('/', ContactMomentController::class)
                    ->names([
                        'index' => 'crm.contact-moments.index',
                        'store' => 'crm.contact-moments.store',
                        'show' => 'crm.contact-moments.show',
                        'update' => 'crm.contact-moments.update',
                        'destroy' => 'crm.contact-moments.destroy',
                    ])
                    ->parameters(['' => 'contactMoment']);
            });
    });
