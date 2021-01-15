<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'checkConfig'], function () {
    Route::group(['middleware' => 'auth'], function (){
        Route::get('/', function () {
            return view('home');
        });

        //account info
        Route::get('/account/{id}/info','UsersController@getDetailUser')->name('account.info');
        Route::post('/account/udate/password','UsersController@updatePasswordAccount')->name('account.update.password');
        Route::post('/account/update/detail','UsersController@updateAccountInfo')->name('account.update.info');
        //company
        Route::get('/company', 'CompanyController@index')->name('company.index');
        Route::post('company/add', 'CompanyController@add')->name('company.add');
        Route::get('/company/switch', 'CompanyController@switch')->name('company.switch');
        Route::get('/company/detail/{id}', 'CompanyController@detail')->name('company.detail');
        Route::post('/company/delete', 'CompanyController@delete')->name('company.delete');
        Route::post('/company/edit', 'CompanyController@edit')->name('company.edit');
        Route::get('/company/role-control/{id}', 'CompanyController@role_controll')->name('company.role_controll');

        //User
        Route::post('/user/add', 'UsersController@add')->name('user.add');
        Route::post('/user/delete', 'UsersController@delete')->name('user.delete');
        Route::post('/user/edit', 'UsersController@edit')->name('user.edit');
        Route::get('/user/{id}/privilege','UsersController@getUserPrivilege')->name('user.privilege');
        Route::post('/uprivilege/{id}/edit', 'UsersController@updatePrivilege')->name('user.uprivilege');
        Route::get('/user/getuser/{id_company}','UsersController@getUsers')->name('user.getUsers');
        Route::get('/user/getcompany_name','UsersController@getCompany')->name('user.getCompany');

        //Division
        // Route::get('/division', 'DivisionController@index')->name('division.index');
        Route::post('/division', 'DivisionController@store')->name('division.store');
        Route::post('/division/{id}/update', 'DivisionController@update')->name('division.update');
        Route::delete('/division/{id}/delete', 'DivisionController@delete')->name('division.delete');

        //Role
        // Route::get('/role', 'RoleController@index')->name('role.index');
        Route::post('/role', 'RoleController@store')->name('role.store');
        Route::post('/role/{id}/update', 'RoleController@update')->name('role.update');
        Route::delete('/role/{id}/delete', 'RoleController@delete')->name('role.delete');

        //Role Division (Position)
        // Route::get('/rolediv', 'RoleDivController@index')->name('rolediv.index');
        Route::post('/rolediv', 'RoleDivController@store')->name('rolediv.store');
        Route::post('/rolediv/{id}/update', 'RoleDivController@update')->name('rolediv.update');
        Route::delete('/rolediv/{id}/delete', 'RoleDivController@delete')->name('rolediv.delete');
        Route::get('/rprivilege/{id}/edit', 'RoleDivController@editPrivilege')->name('rprivilege.edit');
        Route::post('/rprivilege/{id}/edit', 'RoleDivController@updatePrivilege')->name('rprivilege.update');

        //Module
        // Route::get('/module', 'ModuleController@index')->name('module.index');
        Route::post('/module', 'ModuleController@store')->name('module.store');
        Route::post('/module/{id}/update', 'ModuleController@update')->name('module.update');
        Route::delete('/module/{id}/delete', 'ModuleController@delete')->name('module.delete');

        //Action
        //Route::get('/action', ['middleware' => ['role:action|access'], 'as' => 'editor.action.index', 'uses' => 'ActionController@index']);
        // Route::get('/action', 'ActionController@index')->name('action.index');
        Route::post('/action', 'ActionController@store')->name('action.store');
        Route::post('/action/{id}/update', 'ActionController@update')->name('action.update');
        Route::delete('/action/{id}/delete', 'ActionController@delete')->name('action.delete');
        // Route::post('/action/bulkdelete', 'ActionController@bulkDelete')->name('action.bulkdelete');

        /////hrd
        //employee
        Route::get('/hrd/getEmployee_data','HrdEmployeeController@getEmpGet')->name('employee.getdata');
        Route::post('/hrd/getEmployee_data_post','HrdEmployeeController@getEmp')->name('employee.getdata_post');
        Route::get('/hrd/employee', 'HrdEmployeeController@index')->name('employee.index');
        Route::get('/hrd/employee/expel/{id}', 'HrdEmployeeController@expelEmp')->name('employee.expel');
        Route::get('/hrd/employee/nik','HrdEmployeeController@nikFunction')->name('employee.nik');
        Route::get('/hrd/employee/thp','HrdEmployeeController@thpBreakdown')->name('employee.thp');
        Route::post('/hrd/employee/store','HrdEmployeeController@store')->name('employee.add');
        Route::get('/hrd/employee/{id}/detail','HrdEmployeeController@getDetail')->name('employee.detail');
        Route::post('/hrd/employee/{id}/delete','HrdEmployeeController@delete')->name('employee.delete');
        Route::post('/hrd/employee/{id}/update','HrdEmployeeController@update')->name('employee.update');
        Route::post('/hrd/employee/{id}/updateAttach','HrdEmployeeController@updateAttach')->name('employee.updateAttach');
        Route::post('/hrd/employee/{id}/updateJoinDate','HrdEmployeeController@updateJoinDate')->name('employee.updateJoinDate');
        Route::post('/hrd/employee/{id}/updateFinMan','HrdEmployeeController@updateFinMan')->name('employee.updateFinMan');
        Route::post('/hrd/employee/detail/needsec/submit','HrdEmployeeController@submitNeedsec')->name('emp_fin.needsec.submit');
        Route::post('/hrd/employee/renewcontract','HrdEmployeeController@addContract')->name('employee.addcontract');

        //loanemployee
        Route::get('/hrd/employee/loan','HrdEmployeeController@getIndexEmployeeLoan')->name('employee.loan');
        Route::post('/hrd/employee/loan/{id}/loandelete','HrdEmployeeController@loandelete')->name('employee.loan.delete');
        Route::post('/hrd/employee/loan/store','HrdEmployeeController@addLoan')->name('employee.loan.store');
        Route::get('/hrd/employee/loan/{id}/detail','HrdEmployeeController@getDetailLoan')->name('employee.loan.detail');
        Route::post('/hrd/employee/loan/payment', 'HrdEmployeeController@storeLoanPayment')->name('employee.loan.payment');

        //overtime
        Route::get('/hrd/overtime','HrdOvertimeController@index')->name('overtime.index');
        Route::post('/hrd/overtime','HrdOvertimeController@getOvertime')->name('overtime.ot');
        Route::post('/hrd/overtime/store','HrdOvertimeController@storeOvertime')->name('overtime.storeOvertime');
        Route::get('/hrd/overtime/{id}/detail/{year}/{month}','HrdOvertimeController@getDetail')->name('overtime.detail');

        //subsidies
        Route::get('/hrd/subsidies','HrdBonusController@index')->name('subsidies.index');
        Route::post('/hrd/subsidies/store', 'HrdBonusController@addSubsidies')->name('subsidies.store');
        Route::post('/hrd/subsidies/{id}/delete','HrdBonusController@delete')->name('subsidies.delete');
        Route::get('/hrd/subsidies/{id}/payment','HrdBonusController@getDetailBonus')->name('subsidies.payment');
        Route::post('/hrd/subsidies/payment/store', 'HrdBonusController@storePayment')->name('subsidies.payment.store');

        // PAYROLL
        Route::get('/hrd/payroll', 'HrdPayrollController@index')->name('payroll.index');
        Route::post('/hrd/payroll', 'HrdPayrollController@show')->name('payroll.show');
        Route::post('/hrd/payroll/export', 'HrdPayrollController@export')->name('payroll.export');
        Route::get('/hrd/payroll/remarks-btl', 'HrdPayrollController@print_btl')->name('payroll.remarks_btl');
        Route::get('/hrd/payroll/print-btl', 'HrdPayrollController@print_btl')->name('payroll.print_btl');
        Route::post('/hrd/payroll/update', 'HrdPayrollController@update')->name('payroll.update');
        Route::post('/hrd/payroll/remarks-save', 'HrdPayrollController@save_remarks')->name('payroll.remarks_save');

        //POINT
        Route::get('/hrd/point', 'HrdPointController@index')->name('point.index');
        Route::get('/hrd/point/delete/{id?}', 'HrdPointController@delete')->name('point.delete');
        Route::post('/hrd/point/add', 'HrdPointController@add')->name('point.add');
        Route::post('/hrd/point/approve', 'HrdPointController@approve')->name('point.approve');

        // SEVERANCE
        Route::get('/hrd/severance', 'HrdSeveranceController@index')->name('severance.index');
        Route::get('/hrd/severance/delete/{id?}', 'HrdSeveranceController@delete')->name('severance.delete');
        Route::post('/hrd/severance/add', 'HrdSeveranceController@add')->name('severance.add');
        Route::post('/hrd/severance/approve', 'HrdSeveranceController@approve')->name('severance.approve');
        Route::get('/hrd/severance/print/{id?}', 'HrdSeveranceController@print')->name('severance.print');

        //needsec
        Route::get('/hrd/payroll/needsec', 'HrdPayrollController@needsec')->name('payroll.needsec');
        Route::post('/hrd/payroll/needsec/submit', 'HrdPayrollController@submitNeedsec')->name('payroll.submitNeedsec');
        Route::get('/hrd/salarylist/needsec', 'SalaryListController@needsec')->name('salarylist.needsec');
        Route::post('/hrd/salarylist/needsec/submit', 'SalaryListController@submitNeedsec')->name('salarylist.submitNeedsec');

        // //training
        // Route::get('/hrd/training','HrdTrainingController@index')->name('training.index');
        // Route::post('/hrd/training/store', 'HrdTrainingController@store')->name('training.store');
        // Route::post('/hrd/training/{id}/update','HrdTrainingController@update')->name('training.update');
        // Route::post('/hrd/training/{id}/delete','HrdTrainingController@delete')->name('training.delete');
        // Route::post('/hrd/training/{docid}/deletedoc','HrdTrainingController@deleteDoc')->name('training.deletedoc');
        // Route::post('/hrd/training/{docid}/deletevid','HrdTrainingController@deleteVid')->name('training.deletevid');

         //training
        Route::get('/hrd/training','HrdTrainingController@index')->name('training.index');
        Route::get('/hrd/training/detail/{id}','HrdTrainingController@getDetailTraining')->name('training.detail');
        Route::post('/hrd/training/store', 'HrdTrainingController@store')->name('training.store');
        Route::post('/hrd/training/{id}/update','HrdTrainingController@update')->name('training.update');
        Route::post('/hrd/training/{id}/delete','HrdTrainingController@delete')->name('training.delete');
        Route::post('/hrd/training/{docid}/deletedoc','HrdTrainingController@deleteDoc')->name('training.deletedoc');
        Route::post('/hrd/training/{docid}/deletevid','HrdTrainingController@deleteVid')->name('training.deletevid');
        Route::post('/hrd/training/saveScoreUsers','HrdTrainingController@saveScore')->name('training.saveScore');
        Route::post('/hrd/training/addParticipants','HrdTrainingController@saveParticipant')->name('training.saveParticipant');
        Route::get('/hrd/training/deleteParticipant/{id}','HrdTrainingController@deleteParticipant')->name('training.deleteparticipant');

        //training point
        Route::post('/hrd/settingpoint', 'HrdTrainingController@settingPoint')->name('settingpoint.store');

        //decree
        Route::get('/hrd/official-letter','UtilDecreeController@index')->name('decree.index');
        Route::post('/hrd/official-letter', 'UtilDecreeController@addDecree')->name('decree.store');
        Route::get('/hrd/official-letter/delete/{id}','UtilDecreeController@delete')->name('decree.delete');

        //policy
        Route::get('/hrd/policy','PolicyMainController@index')->name('policy.index');
        Route::get('/hrd/policy/category','PolicyMainController@indexCategory')->name('policy.category');
        Route::post('/hrd/policy/store','PolicyMainController@store')->name('policy.store');
        Route::post('/hrd/policy/detail/store','PolicyMainController@storeDetailPolicy')->name('policy.storeDetail');
        Route::post('/hrd/policy/category/storeCategory','PolicyMainController@storeCategory')->name('policy.storeCategory');
        Route::get('/hrd/policy/delete/{id}','PolicyMainController@delete')->name('policy.delete');
        Route::get('/hrd/policy/detail/{id}','PolicyMainController@getDetailPolicy')->name('policy.detail');
        Route::get('/hrd/policy/detail/delete/{id}/{id_main}','PolicyMainController@deleteDetail')->name('policy.detail.delete');
        Route::get('/hrd/policy/detail/view/{id}/{type?}','PolicyMainController@viewApprove')->name('policy.detail.viewappr');
        Route::post('/hrd/policy/detail/viewapprove','PolicyMainController@approve')->name('policy.detail.viewappr.submit');

        //qhse
        //csr
        Route::get('/qhse/csr','CSRController@index')->name('csr.index');
        Route::post('qhse/csr','CSRController@storeCSR')->name('csr.store');
        Route::post('qhse/csr/publish','CSRController@publishCSR')->name('csr.publish');
        Route::get('/qhse/csr/delete/{id}','CSRController@delete')->name('csr.delete');

        //mcu
        Route::get('/qhse/mcu','MCUController@index')->name('mcu.index');
        Route::post('/qhse/mcu','MCUController@storeMCU')->name('mcu.store');
        Route::post('/qhse/mcu/log','MCUController@storeMCULog')->name('mcu.storeLog');
        Route::get('/qhse/mcu/delete/{id}','MCUController@delete')->name('mcu.delete');
        Route::get('/qhse/mcu/log/{id}','MCUController@getLogMCU')->name('mcu.logs');

//salarylist
        Route::get('/dirut/salarylist','SalaryListController@index')->name('salarylist.index');
        Route::get('/dirut/salarylist/history/{id}','SalaryListController@getSalaryHistory')->name('salarylist.history');
        Route::post('/dirut/salarylist/save','SalaryListController@save')->name('salarylist.save');
        Route::post('/dirut/salarylist/reset','SalaryListController@reset')->name('salarylist.reset');
        Route::post('/dirut/salarylist/generateTHR','SalaryListController@generateTHR')->name('salarylist.generateTHR');

        ////marketing
        /// client
        Route::get('/marketing/clients','MarketingClients@index')->name('marketing.client.index');
        Route::post('/marketing/store','MarketingClients@store')->name('marketing.client.store');
        Route::get('/marketing/{id}/delete','MarketingClients@delete')->name('marketing.client.delete');
        Route::post('/marketing/update','MarketingClients@update')->name('marketing.client.update');
        Route::post('/marketing/add-js','MarketingClients@add_js')->name('marketing.client.add.js');
        Route::get('/marketing/get-clients','MarketingClients@get_clients')->name('marketing.client.get.js');

        /// leads
        Route::get('/marketing/leads', 'MarketingLeadsController@index')->name('leads.index');
        Route::get('/marketing/leads/delete/{id?}', 'MarketingLeadsController@delete')->name('leads.delete');
        Route::get('/marketing/leads/view/{id?}', 'MarketingLeadsController@view')->name('leads.view');
        Route::post('/marketing/leads/add', 'MarketingLeadsController@add')->name('leads.add');
        Route::post('/marketing/leads/edit', 'MarketingLeadsController@edit')->name('leads.edit');
        Route::post('/marketing/leads/update_progress', 'MarketingLeadsController@update_progress')->name('leads.update_progress');
        Route::post('/marketing/leads/upload-file', 'MarketingLeadsController@upload_file')->name('leads.upload_file');
        Route::get('/marketing/leads/delete-file/{id?}', 'MarketingLeadsController@delete_file')->name('leads.delete_file');
        Route::post('/marketing/leads/add-contributors', 'MarketingLeadsController@add_contributors')->name('leads.add_contributors');
        Route::post('/marketing/leads/edit/partner', 'MarketingLeadsController@edit_partner')->name('leads.edit_partner');
        Route::get('/marketing/leads/approve/{id?}','MarketingLeadsController@approveLeads')->name('leads.approve');
        Route::post('/marketing/leads/upload-progress/{type?}', 'MarketingLeadsController@upload_progress')->name('leads.upload_progress');
        Route::get('/marketing/leads/management', 'MarketingLeadsController@index_management')->name('leads.index_management');
        Route::post('/marketing/leads/category/add','MarketingLeadsController@insertLeadsCategory')->name('leads.cat.add');
        Route::get('/marketing/get-leadscat','MarketingLeadsController@get_categories')->name('leads.get_categories.js');

        //contract leads
        Route::post('/marketing/leads/addContract','MarketingLeadsController@addContracts')->name('lead.contract.add');
        Route::post('/marketing/leads/editContract','MarketingLeadsController@editContracts')->name('lead.contract.edit');
        Route::post('/marketing/leads/editInvContract','MarketingLeadsController@editInvContracts')->name('lead.contract.editInv');
        Route::get('/marketing/leads/{id_lead}/contract/{id}/delete','MarketingLeadsController@deleteContracts')->name('lead.contract.delete');

        //note leads
        Route::post('/marketing/leads/addNote','MarketingLeadsController@addNotes')->name('notes.store');
        Route::get('/marketing/leads/{id_lead}/note/{id}/delete','MarketingLeadsController@deleteNotes')->name('notes.delete');

        //task lead
        Route::post('/marketing/lead/addTasks','MarketingLeadsController@addTasks')->name('tasks.store');
        Route::post('/marketing/lead/followup', 'MarketingLeadsController@taskFollow')->name('tasks.follow');
        Route::get('/marketing/leads/{id}/task/{id_task}/delete','MarketingLeadsController@deleteTasks')->name('task.delete');

        //meeting leads
        Route::post('/marketing/lead/addMeeting','MarketingLeadsController@addMeetings')->name('meetings.store');
        Route::get('/marketing/leads/{id}/meeting/{id_meeting}/delete','MarketingLeadsController@deleteMeetings')->name('meeting.delete');

        /// projects
        Route::get('/marketing/projects/{view?}','MarketingProjectsController@indexProjects')->name('marketing.project');
        Route::post('/marketing/projects/store','MarketingProjectsController@store')->name('marketing.project.store');
        Route::post('/marketing/projects/update','MarketingProjectsController@update')->name('marketing.project.update');

        // prognosis
        Route::get('/marketing/prognosis/create/{id}','MarketingPrognosisController@index')->name('marketing.prognosis.index');
        Route::post('/marketing/prognosis/add','MarketingPrognosisController@add')->name('marketing.prognosis.add');
        Route::get('/marketing/prognosis/delete/{id?}','MarketingPrognosisController@delete')->name('marketing.prognosis.delete');

        // custom chart
        Route::get('/chart/custom-chart', 'ChartCustomController@index')->name('chart.custom.index');
        Route::get('/chart/custom-chart/view/{id?}', 'ChartCustomController@view')->name('chart.custom.view');
        Route::get('/chart/custom-chart/find/{id?}', 'ChartCustomController@find')->name('chart.custom.find');
        Route::get('/chart/custom-chart/delete/{id?}', 'ChartCustomController@delete')->name('chart.custom.delete');
        Route::post('/chart/custom-chart/add', 'ChartCustomController@add')->name('chart.custom.add');
        Route::post('/chart/custom-chart/update', 'ChartCustomController@update')->name('chart.custom.update');
        Route::get('/chart/custom-chart/get/{id_chart?}', 'ChartCustomController@get_data')->name('chart.custom.get_data');

        ////General
        /// SO
         Route::get('/general/sowaiting','AssetSreController@getSoWaiting')->name('so.waiting');
        Route::get('/general/sobank','AssetSreController@getSoBank')->name('so.bank');
        Route::get('/general/soreject','AssetSreController@getSoReject')->name('so.rejected');
        Route::get('/general/so', 'AssetSreController@so_index')->name('general.so');
        Route::post('/general/so/add', 'AssetSreController@so_add')->name('so.add');
        Route::get('/genera/so/appr/{id}', 'AssetSreController@so_appr')->name('so.appr');
        Route::get('/genera/so/view/{id}', 'AssetSreController@so_view')->name('so.view');
        Route::post('/general/so/approve', 'AssetSreController@so_approve')->name('so.approve');
        Route::post('/general/so/reject', 'AssetSreController@so_reject')->name('so.reject');

        /// SR
        Route::get('/general/sr', 'AssetSreController@sr_index')->name('sr.index');
        Route::get('/genera/sr/view/{id}', 'AssetSreController@sr_view')->name('sr.view');
        Route::get('/general/sr/appr/{id}', 'AssetSreController@sr_appr')->name('sr.appr');
        Route::post('/general/sr/approve', 'AssetSreController@sr_approve')->name('sr.approve');
        Route::post('/general/sr/reject', 'AssetSreController@sr_reject')->name('sr.reject');

        /// SE
        Route::get('/general/se', 'AssetSreController@se_index')->name('se.index');
        Route::get('/genera/se/appr/{id}', 'AssetSreController@se_appr')->name('se.appr');
        Route::get('/genera/se/view/{id}', 'AssetSreController@se_view')->name('se.view');
        Route::post('/general/se/approve', 'AssetSreController@se_approve')->name('se.approve');
        Route::post('/general/se/reject', 'AssetSreController@se_reject')->name('se.reject');
        Route::post('/general/se/input', 'AssetSreController@se_approve')->name('se.input_post');
        Route::post('/general/se/ack', 'AssetSreController@se_approve')->name('se.ack_post');
        Route::post('/general/se/dir', 'AssetSreController@se_approve')->name('se.dir_post');
        Route::post('/general/se/reject', 'AssetSreController@se_reject')->name('se.reject');

        /// WO
        Route::get('/general/wo', 'AssetWoController@index')->name('general.wo');
        Route::get('/general/wo/appr/{id}', 'AssetWoController@appr')->name('wo.appr');
        Route::get('/general/wo/view/{id}', 'AssetWoController@detail')->name('wo.view');
        Route::post('/general/wo/approve', 'AssetWoController@approve')->name('wo.approve');
        Route::post('/general/wo/reject', 'AssetWoController@reject')->name('wo.reject');
        Route::post('/general/wo/revise', 'AssetWoController@revise')->name('wo.revise');
        Route::post('/general/wo/add-instant', 'AssetWoController@addInstant')->name('wo.addInstant');

        // Leave
        Route::get('/leave', 'LeaveController@index')->name('leave.index');
        Route::get('/leave/request', 'LeaveController@request_form')->name('leave.request');
        Route::post('/leave/submit', 'LeaveController@submit')->name('leave.submit');
        Route::post('/leave/checkcuti', 'LeaveController@checkcuti')->name('leave.checkcuti');
        Route::post('/leave/approve', 'LeaveController@approve')->name('leave.approve');
        Route::get('/leave/delete/{id?}', 'LeaveController@delete')->name('leave.delete');

        //TO
        Route::get('/general/to/{id}/delete','GeneralTravelOrderController@delete')->name('to.delete');
        Route::get('/general/to','GeneralTravelOrderController@index')->name('to.index');
        Route::post('/general/to/add', 'GeneralTravelOrderController@addFirst')->name('to.add');
        Route::post('/general/to/store','GeneralTravelOrderController@store')->name('to.store');
        Route::get('/general/to/{id}/edit','GeneralTravelOrderController@edit')->name('to.edit');
        Route::post('/general/to/update','GeneralTravelOrderController@update')->name('to.update');
        Route::get('/general/to/{id}/ftdetail','GeneralTravelOrderController@getFTdetail')->name('to.ftdetail');
        Route::get('/general/to/{id}/timesheet_approval/{code}','GeneralTravelOrderController@getTimeSheetAppr')->name('to.tsappr');
        Route::post('/general/to/ts_approve','GeneralTravelOrderController@doTSAppr')->name('to.tsdoappr');
        Route::post('/general/to/ts_check','GeneralTravelOrderController@doCheckAppr')->name('to.doCheckAppr');
        Route::post('/general/to/ts_pay','GeneralTravelOrderController@doPayAppr')->name('to.doPayAppr');

        //COA
        Route::get('/finance/coa','FinanceCOAController@index')->name('coa.index');
        Route::post('/finance/coa/store','FinanceCOAController@store')->name('coa.store');
        Route::get('/finance/coa/{id}/delete','FinanceCOAController@delete')->name('coa.delete');
        Route::get('/finance/coa/get', 'FinanceCOAController@getCoa')->name('coa.get');
        Route::get('/finance/coa/view/{id}', 'FinanceCOAController@view')->name('coa.view');
        Route::post('/finance/coa/find', 'FinanceCOAController@find')->name('coa.find');
        Route::post('/finance/coa/update', 'FinanceCOAController@update')->name('coa.update');

        // VENDOR
        //VENDOR
        Route::get('/procurement/vendor','ProcurementVendorController@index')->name('vendor.index');
        Route::get('/procurement/vendor/{id}/edit','ProcurementVendorController@edit')->name('vendor.edit');
        Route::post('/procurement/vendor/store','ProcurementVendorController@storeVendor')->name('vendor.store');
        Route::post('/procurement/vendor/update','ProcurementVendorController@updateVendor')->name('vendor.update');
        Route::get('/procurement/vendor/{id}/delete','ProcurementVendorController@delete')->name('vendor.delete');

        // FR
         Route::get('/general/frwatings', 'AssetPreController@getFrWaiting')->name('fr.getFrWaiting');
        Route::get('/general/frbanks', 'AssetPreController@getFrBank')->name('fr.getFrBank');
        Route::get('/general/frrejects', 'AssetPreController@getFrReject')->name('fr.getFrReject');
        Route::get('/general/fr', 'AssetPreController@indexFr')->name('fr.index');
        Route::post('/general/fr/store','AssetPreController@addFr')->name('fr.add');
        Route::get('/general/fr/getProject/{cat}','AssetPreController@getProject')->name('fr.getProject');
        Route::get('/general/fr/getItems','AssetPreController@getItems')->name('fr.getItems');
        Route::get('/general/fr/{id}/view/{code?}','AssetPreController@frView')->name('fr.view');
        Route::post('/general/fr/appr/division','AssetPreController@apprDiv')->name('fr.appr.div');
        Route::post('/general/fr/appr/asset','AssetPreController@apprAsset')->name('fr.appr.asset');
        Route::post('/general/fr/appr/deliver','AssetPreController@apprDeliver')->name('fr.appr.deliver');
        Route::get('/general/{code}/{id}/delete', 'AssetPreController@delete')->name('fr.pr.delete');
        // PR
        Route::get('/general/pr', 'AssetPreController@indexPr')->name('pr.index');
        Route::get('/general/pr/{id}/view/{code?}','AssetPreController@prView')->name('pr.view');
        Route::post('/general/pr/appr/director','AssetPreController@apprDir')->name('fr.appr.dir');

        // PE
        Route::get('/general/pe', 'AssetPreController@indexPev')->name('pe.index');
        Route::get('/general/pe/view/{id}', 'AssetPreController@pev_view')->name('pe.view');
        Route::get('/general/pe/input/{id}', 'AssetPreController@pc_apprPev')->name('pe.input');
        Route::get('/general/pe/pc/{id}', 'AssetPreController@pc_apprPev')->name('pe.pc_appr');
        Route::get('/general/pe/div/{id}', 'AssetPreController@pc_apprPev')->name('pe.div_appr');
        Route::get('/general/pe/dir/{id}', 'AssetPreController@pc_apprPev')->name('pe.dir_appr');
        Route::post('/general/pe/input', 'AssetPreController@pc_postPev')->name('pe.input_post');
        Route::post('/general/pe/pc', 'AssetPreController@pc_postPev')->name('pe.pc_post');
        Route::post('/general/pe/div', 'AssetPreController@pc_postPev')->name('pe.div_post');
        Route::post('/general/pe/dir', 'AssetPreController@pc_postPev')->name('pe.dir_post');
        Route::post('/general/pe/dir/reject', 'AssetPreController@rejectPev')->name('pe.reject');

        //meeting scheduler

        Route::get('/forum/meeting-scheduler','GeneralMeetingScheduler@index')->name('ms.index');
        Route::get('/forum/meeting-scheduler/{tanggal}','GeneralMeetingScheduler@getRoom')->name('ms.day');
        Route::post('/forum/meeting-scheduler/storeRoom','GeneralMeetingScheduler@newRoom')->name('ms.newroom');
        Route::get('/forum/meeting-scheduler/{tanggal}/book/{id_room}','GeneralMeetingScheduler@getNewBook')->name('ms.book');
        Route::post('/forum/meeting-scheduler/storeRv','GeneralMeetingScheduler@addReservation')->name('ms.addReservation');
        Route::get('/forum/meeting-scheduler/{tanggal}/room/{id_room}/event/{id_book}','GeneralMeetingScheduler@getEvent')->name('ms.event');
        Route::post('/forum/meeting-scheduler/storeEv','GeneralMeetingScheduler@storeEvent')->name('ms.addEvent');
        Route::get('/forum/meeting-scheduler/{tanggal}/absensi/{id_topic}','GeneralMeetingScheduler@getAbsensi')->name('ms.absen');

        //balance sheet
        Route::get('/finance/balance-sheet','FinanceBalanceSheetController@index')->name('bs.index');
        Route::post('/finance/balance-sheet', 'FinanceBalanceSheetController@find')->name('bs.find');
        Route::post('/finance/balance-sheet/setting', 'FinanceBalanceSheetController@setting')->name('bs.setting');

        //GL
        Route::get('/accounting/general-ledger', 'AccountingGeneralLedgerController@index')->name('gl.index');
        Route::post('/accounting/general-ledger/edit', 'AccountingGeneralLedgerController@edit')->name('gl.edit');
        Route::post('/accounting/general-ledger', 'AccountingGeneralLedgerController@index')->name('gl.index');

        // PO
        Route::get('/general/po', 'AssetPoController@index')->name('po.index');
        Route::get('/general/po/appr/{id}', 'AssetPoController@appr')->name('po.appr');
        Route::get('/general/po/view/{id}', 'AssetPoController@detail')->name('po.view');
        Route::post('/general/po/approve', 'AssetPoController@approve')->name('po.approve');
        Route::post('/general/po/reject', 'AssetPoController@reject')->name('po.reject');
        Route::post('/general/po/revise', 'AssetPoController@revise')->name('po.revise');
        Route::post('/general/po/add-instant', 'AssetPoController@addInstant')->name('po.addInstant');

        // GR
        Route::get('/general/gr', 'AssetGoodReceiveController@index')->name('gr.index');
        Route::get('/general/gr/{id}/{type?}','AssetGoodReceiveController@getDetail')->name('gr.detail');
        Route::post('/general/gr/approveGR','AssetGoodReceiveController@approveGR')->name('gr.appr');
        // Treasury
        Route::get('/finance/treasury', 'FinanceTreasuryController@index')->name('treasury.index');
        Route::post('/finance/treasury', 'FinanceTreasuryController@add')->name('treasury.add');
        Route::post('/finance/treasury/delete', 'FinanceTreasuryController@del')->name('treasury.delete');
        Route::post('/finance/treasury/edit', 'FinanceTreasuryController@edit')->name('treasury.edit');
        Route::post('/finance/treasury/deposit', 'FinanceTreasuryController@deposit')->name('treasury.deposit');
        Route::get('/finance/treasury/view/{id}', 'FinanceTreasuryController@view_treasure')->name('treasury.view');
        Route::post('/finance/treasury/approve', 'FinanceTreasuryController@approve')->name('treasury.approve');
        Route::post('/finance/treasury/reject', 'FinanceTreasuryController@reject')->name('treasury.reject');
        Route::post('/finance/treasury/find', 'FinanceTreasuryController@find')->name('treasury.find');
        Route::get('/finance/treasury/history/{id}', 'FinanceTreasuryController@history')->name('treasury.history');
        Route::get('/finance/treasury/coa/{id}', 'FinanceTreasuryController@coa')->name('treasury.coa');
        Route::post('/finance/treasury/coa/', 'FinanceTreasuryController@setcoa')->name('treasury.setcoa');
        Route::post('/finance/treasury/coa/edit', 'FinanceTreasuryController@editcoa')->name('treasury.editcoa');
        Route::get('/finance/treasury/coa/set/{id}', 'FinanceTreasuryController@viewcoa')->name('treasury.viewcoa');
        Route::post('/finance/treasury/sp/find', 'FinanceTreasuryController@findsp')->name('treasury.findsp');
        Route::post('/finance/treasury/sp/add', 'FinanceTreasuryController@addsp')->name('treasury.addsp');
        Route::get('/finance/treasury/sp/view/{id?}', 'FinanceTreasuryController@viewsp')->name('treasury.viewsp');
        Route::post('/finance/treasury/sp/appr', 'FinanceTreasuryController@apprsp')->name('treasury.apprsp');
        Route::get('/finance/treasury/sp/print/{id?}', 'FinanceTreasuryController@printsp')->name('treasury.printsp');

        // General Journal
        Route::get('/finance/general-journal', 'FinanceGeneralJournal@index')->name('gj.index');
        Route::post('/finance/general-journal', 'FinanceGeneralJournal@add')->name('gj.add');
        Route::get('/finance/general-journal/delete/{id?}', 'FinanceGeneralJournal@delete')->name('gj.delete');
        Route::get('/finance/general-journal/find/{md5?}', 'FinanceGeneralJournal@find')->name('gj.find');
        Route::post('/finance/general-journal/edit', 'FinanceGeneralJournal@edit')->name('gj.edit');
        Route::post('/finance/general-journal/approve', 'FinanceGeneralJournal@approve')->name('gj.approve');

        //Forum
        Route::get('/general/forum','ForumController@index')->name('forum.index');
        Route::post('/general/forum','ForumController@storeForum')->name('forum.store');
        Route::get('/general/forum/topic/{id?}','ForumController@getTopic')->name('forum.topic');
        Route::get('/general/forum/topic/posts/{id?}','ForumController@getComments')->name('forum.topic.post');
        Route::post('/general/forum/topic','ForumController@storeTopic')->name('forum.topic.store');
        Route::get('/general/forum/topic/forum/{id}/{id_forum}','ForumController@deleteTopic')->name('forum.topic.delete');
        Route::get('/general/forum/topicAjax/{id?}','ForumController@getTopicAjax')->name('forum.topicAjax');
        Route::post('/general/forum/comment','ForumController@storePost')->name('forum.storepost');
        Route::get('/general/forum/comment/delete/{id}/{id_topik}','ForumController@deletePosts')->name('forum.deletepost');

        //MoM
        Route::get('/general/mom','MOMController@index')->name('mom.index');
        Route::get('/general/momAjax','MOMController@getMtgAjax')->name('mom.get');
        Route::get('/general/momAttendance/{id?}','MOMController@getAbsence')->name('mom.getAbsence');
        Route::get('/general/momMom/{id?}','MOMController@getMom')->name('mom.getMom');
        Route::post('/general/mom','MOMController@storeMain')->name('mom.store');
        Route::post('/general/mom/signatureSave','MOMController@signatureSave')->name('mom.sign.save');
        Route::post('/general/mom/signatureFileSave','MOMController@signatureFileSave')->name('mom.file.save');
        Route::get('/general/mom/detail/{id?}','MOMController@getDetail')->name('mom.detail');
        Route::get('/general/mom/actionprogress/{id?}','MOMController@setActionProgress')->name('mom.action.progress');
        Route::get('/general/mom/delete/{id?}','MOMController@deleteMain')->name('mom.delete.main');
        Route::get('/general/mom/delete/attd/{id}/{id_main}','MOMController@deletAttd')->name('mom.delete.attd');
        Route::get('/general/mom/delete/delMOM/{id}/{id_main}','MOMController@deletDelMOM')->name('mom.delete.delMOM');
        Route::post('/general/mom/detail/storeMOM','MOMController@storeMOM')->name('mom.detail.storeMOM');
        Route::post('/general/mom/detail/updateMOM','MOMController@updateMOM')->name('mom.detail.updateMOM');

        //Profit & Loss
        Route::get('/finance/profit-loss', 'FinanceProfitLossController@index')->name('pl.index');
        Route::post('/finance/profit-loss/setting', 'FinanceProfitLossController@setting')->name('pl.setting');
        Route::post('/finance/profit-loss/find', 'FinanceProfitLossController@find')->name('pl.find');


        //Cashbond
        Route::get('/general/cashbond','GeneralCashbond@index')->name('cashbond.index');
        Route::post('/general/cashbond/store', 'GeneralCashbond@addCashbond')->name('cashbond.add');
        Route::get('/general/cashbond/{id}/detail','GeneralCashbond@getDetail')->name('cashbond.detail');
        Route::post('/general/cashbond/addCashIn', 'GeneralCashbond@addCashIn')->name('cashbond.addCashIn');
        Route::post('/general/cashbond/addCashOut', 'GeneralCashbond@addCashOut')->name('cashbond.addCashOut');
        Route::post('/general/cashbond/RAppr', 'GeneralCashbond@RAppr')->name('cashbond.RAppr');
        Route::get('/general/cashbond/{id}/delete/{id_cb}','GeneralCashbond@deleteDetail')->name('cashbond.deleteDetail');
        Route::get('/general/cashbond/{id}/delete','GeneralCashbond@delete')->name('cashbond.delete');
        Route::get('/general/cashbond/{id}/getDetRA/{who?}','GeneralCashbond@getDetRA')->name('cashbond.getDetRA');


        //Reimburse
        Route::get('/general/reimburse','GeneralReimburse@index')->name('reimburse.index');
        Route::post('/general/reimburse/store', 'GeneralReimburse@addReimburse')->name('reimburse.add');
        Route::get('/general/reimburse/{id}/detail','GeneralReimburse@getDetail')->name('reimburse.detail');
        Route::post('/general/reimburse/addCashOut', 'GeneralReimburse@addCashOut')->name('reimburse.addCashOut');
        Route::get('/general/reimburse/{id}/delete/{id_cb}','GeneralReimburse@deleteDetail')->name('reimburse.deleteDetail');
        Route::get('/general/reimburse/{id}/delete','GeneralReimburse@delete')->name('reimburse.delete');
        Route::get('/general/reimburse/{id}/getDetRA/{who?}','GeneralReimburse@getDetRA')->name('reimburse.getDetRA');
        Route::post('/general/reimburse/RAppr', 'GeneralReimburse@RAppr')->name('reimburse.RAppr');

        // // Items
        // Route::get('/asset/items/item_code','AssetItemsController@itemCodeFunction')->name('items.itemCodeFunction');
        // Route::get('/asset/items/list', 'AssetItemsController@indexInventory')->name('items.inventory');
        // Route::get('/asset/items/list/withcategory/{category?}', 'AssetItemsController@index')->name('items.index');
        // Route::post('/asset/items', 'AssetItemsController@addItem')->name('items.add');
        // Route::post('/asset/items/find', 'AssetItemsController@find_item')->name('items.find');
        // Route::post('/asset/items/edit', 'AssetItemsController@edit_item')->name('items.edit');
        // Route::post('/asset/items/delete', 'AssetItemsController@delete')->name('items.delete');
        // Route::get('/asset/items/revision', 'AssetItemsController@revision')->name('items.revision');
        // Route::get('/asset/items/revision/{id}', 'AssetItemsController@revision_detail')->name('items.revision_detail');
        // Route::post('/asset/items/revision/update', 'AssetItemsController@revision_update')->name('items.revision_update');
        // Route::post('/asset/items/revision/delete', 'AssetItemsController@revision_delete')->name('items.revision_delete');
        // Route::get('/asset/items/list/warehouse/list/{id_wh}', 'AssetItemsController@getItemWh')->name('items.warehouses');
        // Route::get('/asset/items/transaction/find/{id?}', 'AssetItemsController@find_transaction')->name('items.find_transaction');

        // //category
        // Route::get('/asset/items','AssetNewCategoryController@index')->name('category.index');
        // Route::get('/asset/items/category','AssetNewCategoryController@getCategory')->name('category.get');
        // Route::post('/asset/items/category/update','AssetNewCategoryController@update')->name('category.update');
        // Route::post('/asset/items/category/store','AssetNewCategoryController@store')->name('category.store');
        // Route::get('/asset/items/category/{id}/del','AssetNewCategoryController@delete')->name('category.del');
        // Route::get('/asset/items/category/cari','AssetNewCategory@loadData')->name('category.cari');

        // //Classification
        // Route::get('/asset/items/classification/{category?}','AssetItemsClassificationController@index')->name('item_class.index');
        // Route::get('/asset/items/classification/getclassification/{id}','AssetItemsClassificationController@getClassification')->name('item_class.getclass');
        // Route::post('/asset/items/classification/store','AssetItemsClassificationController@store')->name('item_class.store');
        // Route::post('/asset/items/classification/update','AssetItemsClassificationController@update')->name('item_class.update');
        // Route::get('/asset/items/classification/delete/{id}','AssetItemsClassificationController@delete')->name('item_class.delete');

        // Items
        Route::get('/asset/items/item_code','AssetItemsController@itemCodeFunction')->name('items.itemCodeFunction');
        Route::get('/asset/items/list', 'AssetItemsController@indexInventory')->name('items.inventory');
        Route::get('/asset/items/list/withcategory/{category?}/{classification?}', 'AssetItemsController@index')->name('items.index');
        Route::get('/asset/items/list/class/{category?}','AssetItemsController@indexClassification')->name('items.class.index');
        Route::post('/asset/items', 'AssetItemsController@addItem')->name('items.add');
        Route::post('/asset/items/find', 'AssetItemsController@find_item')->name('items.find');
        Route::post('/asset/items/edit', 'AssetItemsController@edit_item')->name('items.edit');
        Route::post('/asset/items/delete', 'AssetItemsController@delete')->name('items.delete');
        Route::get('/asset/items/revision', 'AssetItemsController@revision')->name('items.revision');
        Route::get('/asset/items/revision/{id}', 'AssetItemsController@revision_detail')->name('items.revision_detail');
        Route::post('/asset/items/revision/update', 'AssetItemsController@revision_update')->name('items.revision_update');
        Route::post('/asset/items/revision/delete', 'AssetItemsController@revision_delete')->name('items.revision_delete');
        Route::get('/asset/items/list/warehouse/list/{id_wh}', 'AssetItemsController@getItemWh')->name('items.warehouses');
        Route::get('/asset/items/transaction/find/{id?}', 'AssetItemsController@find_transaction')->name('items.find_transaction');

        //category
        Route::get('/asset/items','AssetNewCategoryController@index')->name('category.index');
        Route::get('/asset/items/category','AssetNewCategoryController@getCategory')->name('category.get');
        Route::post('/asset/items/category/update','AssetNewCategoryController@update')->name('category.update');
        Route::post('/asset/items/category/store','AssetNewCategoryController@store')->name('category.store');
        Route::get('/asset/items/category/{id}/del','AssetNewCategoryController@delete')->name('category.del');
        Route::get('/asset/items/category/cari','AssetNewCategory@loadData')->name('category.cari');

        //Classification
        Route::get('/asset/items/classification/{category?}','AssetItemsClassificationController@index')->name('item_class.index');
        Route::get('/asset/items/classification/getclassification/{id?}/{class_id?}','AssetItemsClassificationController@getClassification')->name('item_class.getclass');
        Route::post('/asset/items/classification/store','AssetItemsClassificationController@store')->name('item_class.store');
        Route::post('/asset/items/classification/update','AssetItemsClassificationController@update')->name('item_class.update');
        Route::get('/asset/items/classification/delete/{id}','AssetItemsClassificationController@delete')->name('item_class.delete');


        // INVOICE IN
        Route::get('/finance/invoice-in/', 'FinanceInvoiceIn@index')->name('inv_in.index');
        Route::get('/finance/invoice-in/view/{id}', 'FinanceInvoiceIn@view')->name('inv_in.view');
        Route::post('/finance/invoice-in/delete/', 'FinanceInvoiceIn@delete')->name('inv_in.delete');
        Route::post('/finance/invoice-in/delete_pay', 'FinanceInvoiceIn@delete_pay')->name('inv_in.delete_pay');
        Route::post('/finance/invoice-in/search', 'FinanceInvoiceIn@search_paper')->name('inv_in.search');
        Route::post('/finance/invoice-in/add', 'FinanceInvoiceIn@add')->name('inv_in.add');
        Route::post('/finance/invoice-in/pay', 'FinanceInvoiceIn@pay')->name('inv_in.pay');
        Route::post('/finance/invoice-in/duedate', 'FinanceInvoiceIn@duedate')->name('inv_in.duedate');

        // Account Receivable
        Route::get('/finance/invoice-out', 'FinanceAccountReceivable@index')->name('ar.index');
        Route::get('/finance/invoice-out/pl/{id?}', 'FinanceAccountReceivable@getProjectLeads')->name('ar.getpl');
        Route::get('/finance/invoice-out/delete/{id?}', 'FinanceAccountReceivable@delete')->name('ar.delete');
        Route::get('/finance/invoice-out/delete-entry/{id?}', 'FinanceAccountReceivable@delete_entry')->name('ar.delete_entry');
        Route::get('/finance/invoice-out/view/{id}', 'FinanceAccountReceivable@view')->name('ar.view');
        Route::get('/finance/invoice-out/input-entry/{id}', 'FinanceAccountReceivable@input_entry')->name('ar.input_entry');
        Route::get('/finance/invoice-out/view-entry/{id}/{act}', 'FinanceAccountReceivable@view_entry')->name('ar.view_entry');
        Route::get('/finance/invoice-out/check-inv/{id?}', 'FinanceAccountReceivable@check_inv')->name('ar.check_inv');
        Route::post('/finance/invoice-out/add', 'FinanceAccountReceivable@add')->name('ar.add');
        Route::post('/finance/invoice-out/add-entry', 'FinanceAccountReceivable@addEntry')->name('ar.addEntry');
        Route::post('/finance/invoice-out/add-input', 'FinanceAccountReceivable@add_input')->name('ar.add_input');
        Route::post('/finance/invoice-out/appr-manager', 'FinanceAccountReceivable@appr_manager')->name('ar.appr_manager');
        Route::post('/finance/invoice-out/appr-finance', 'FinanceAccountReceivable@appr_finance')->name('ar.appr_finance');
        Route::post('/finance/invoice-out/revise', 'FinanceAccountReceivable@revise')->name('ar.revise');

        //sanction
        Route::get('/hrd/deduction','HrdSanctionController@index')->name('sanction.index');
        Route::post('/hrd/deduction/store', 'HrdSanctionController@addDeduction')->name('sanction.store');
        Route::post('/hrd/deduction/{id}/delete','HrdSanctionController@delete')->name('sanction.delete');
        Route::post('/hrd/deduction/{id}/approve','HrdSanctionController@approveDeduction')->name('sanction.approve');

        //salary_financing
        Route::get('/finance/salary_financing','FinanceSPController@getSalaryFinancing')->name('salfin.index');
        Route::get('/finance/salary_financing/stat','FinanceSPController@getSalaryFinancingStat')->name('salfin.stat');
        Route::post('/finance/salary_financing','FinanceSPController@paySalaryFinancing')->name('salfin.pay');

        //SCHEDULE PAYMENT
        Route::get('/finance/schedule-payment', 'FinanceSPController@index')->name('sp.index');
        Route::get('/finance/schedule-payment/{date?}', 'FinanceSPController@pay')->name('sp.pay');
        Route::post('/finance/schedule-payment', 'FinanceSPController@index')->name('sp.index');
        Route::post('/finance/schedule-payment/confirm', 'FinanceSPController@confirm')->name('sp.confirm');
        Route::post('/finance/schedule-payment/edit-date', 'FinanceSPController@edit_date')->name('sp.edit_date');
        Route::post('/finance/schedule-payment/history', 'FinanceSPController@history')->name('sp.history');

        //Sub Cost
        Route::get('/marketing/subcost','MarketingSubcostController@index')->name('subcost.index');
        Route::get('/marketing/subcost/{id}/done','MarketingSubcostController@submitDone')->name('subcost.done');
        Route::get('/marketing/subcost/{id}/detail','MarketingSubcostController@getDetail')->name('subcost.detail');
        Route::post('/marketing/subcost/addCash', 'MarketingSubcostController@addCash')->name('subcost.addCash');
        Route::get('/marketing/subcost/{id}/delete/{id_detail}','MarketingSubcostController@deleteSubcostDetail')->name('subcost.delete.detail');
        Route::get('/marketing/subcost/{id}/approve/{id_detail}/{type}','MarketingSubcostController@submitApprove')->name('subcost.approve');
        Route::post('/marketing/subcost/apprFin','MarketingSubcostController@submitApproveFin')->name('subcost.approveFin');

        Route::get('/general/crewloc','GeneralCrewLocationController@index')->name('crewloc.index');
        Route::post('/general/crewloc/storeplan','GeneralCrewLocationController@addToPlan')->name('crewloc.storeplan');

        //BP
        Route::get('/marketing/bp','MarketingBpController@index')->name('bp.index');
        Route::post('/marketing/bp/store','MarketingBpController@addBP')->name('bp.add');
        Route::get('/marketing/bp/{id}/findiv', 'MarketingBpController@getFinDiv')->name('bp.findiv');
        Route::post('/marketing/bp/findivappr', 'MarketingBpController@finDivAppr')->name('bp.finDivAppr');
        Route::get('/marketing/bp/{id}/findiv/{code}', 'MarketingBpController@getDirAppr')->name('bp.getDirAppr');
        Route::post('/marketing/bp/submitAppr','MarketingBpController@submitAppr')->name('bp.submitappr');
        Route::post('/marketing/bp/submitBondR','MarketingBpController@bondR')->name('bp.bondR');

        //Finance Loan
        Route::get('/finance/loan', 'FinanceLoanController@index')->name('loan.index');
        Route::get('/finance/loan/{id}', 'FinanceLoanController@detail')->name('loan.detail');
        Route::post('/finance/loan/add', 'FinanceLoanController@add')->name('loan.add');
        Route::post('/finance/loan/save-plan', 'FinanceLoanController@save_plan')->name('loan.save_plan');
        Route::post('/finance/loan/update-plan', 'FinanceLoanController@update_plan')->name('loan.update_plan');
        Route::get('/finance/loan/edit-plan/{id}', 'FinanceLoanController@edit_plan')->name('loan.edit_plan');
        Route::post('/finance/loan/delete', 'FinanceLoanController@delete')->name('loan.delete');

        //Finance Leasing
        Route::get('/finance/leasing', 'FinanceLeasingController@index')->name('leasing.index');
        Route::get('/finance/leasing/{id}', 'FinanceLeasingController@detail')->name('leasing.detail');
        Route::post('/finance/leasing/add', 'FinanceLeasingController@add')->name('leasing.add');
        Route::post('/finance/leasing/save-plan', 'FinanceLeasingController@save_plan')->name('leasing.save_plan');
        Route::post('/finance/leasing/update-plan', 'FinanceLeasingController@update_plan')->name('leasing.update_plan');
        Route::get('/finance/leasing/edit-plan/{id}', 'FinanceLeasingController@edit_plan')->name('leasing.edit_plan');
        Route::post('/finance/leasing/delete', 'FinanceLeasingController@delete')->name('leasing.delete');

        //Finance Utilization
        Route::get('/finance/utilization', 'FinanceUtilizationController@index')->name('util.index');
        Route::get('/finance/utilization/get-date/{date?}', 'FinanceUtilizationController@getDateMonth')->name('util.getdate');
        Route::get('/finance/utilization/update-status/{id?}', 'FinanceUtilizationController@update_status')->name('util.update_status');
        Route::get('/finance/utilization/criteria/delete/{id?}', 'FinanceUtilizationController@deleteCriteria')->name('util.delete.criteria');
        Route::get('/finance/utilization/instance/delete/{id?}', 'FinanceUtilizationController@deleteInstance')->name('util.delete.instance');
        Route::get('/finance/utilization/view/{id}', 'FinanceUtilizationController@view')->name('util.view');
        Route::post('/finance/utilization/criteria', 'FinanceUtilizationController@addCriteria')->name('util.add.criteria');
        Route::post('/finance/utilization/add', 'FinanceUtilizationController@add')->name('util.add');
        Route::post('/finance/utilization/delete', 'FinanceUtilizationController@delete')->name('util.delete');
        Route::post('/finance/utilization/change-amount', 'FinanceUtilizationController@change_amount')->name('util.change_amount');
        Route::post('/finance/utilization/change-amount-instance', 'FinanceUtilizationController@change_amount_instance')->name('util.change_amount_instance');

        //Finance Tax
        Route::get('/finance/tax', 'FinanceTaxController@index')->name('tax.index');
        Route::post('/finance/tax/data', 'FinanceTaxController@get_data')->name('tax.get_data');

        //Finance Business
        Route::get('/finance/business', 'FinanceBusinessController@index')->name('business.index');
        Route::get('/finance/delete/{id?}', 'FinanceBusinessController@delete')->name('business.delete');
        Route::get('/finance/business/detail/{id}', 'FinanceBusinessController@detail')->name('business.detail');
        Route::get('/finance/business/investor/detail/{id}', 'FinanceBusinessController@investor')->name('business.investor');
        Route::get('/finance/business/investor/delete', 'FinanceBusinessController@deleteInvestor')->name('business.deleteInvestor');
        Route::get('/finance/business/investor/delete-investment', 'FinanceBusinessController@deleteInvesment')->name('business.deleteInvesment');
        Route::get('/finance/business/edit/{id?}', 'FinanceBusinessController@edit')->name('business.edit');
        Route::get('/finance/business/pay/{id?}', 'FinanceBusinessController@pay')->name('business.pay');
        Route::get('/finance/business/investor/pay', 'FinanceBusinessController@investorPay')->name('business.investorPay');
        Route::get('/finance/business/print/{id?}', 'FinanceBusinessController@print')->name('business.print');

        Route::post('/finance/business/add', 'FinanceBusinessController@add')->name('business.add');
        Route::post('/finance/business/update', 'FinanceBusinessController@update')->name('business.update');
        Route::post('/finance/business/pay', 'FinanceBusinessController@payConfirm')->name('business.payConfirm');
        Route::post('/finance/business/investor/add', 'FinanceBusinessController@addInvestor')->name('business.addInvestor');
        Route::post('/finance/business/investor/update-rate', 'FinanceBusinessController@updateRate')->name('business.updateRate');
        Route::post('/finance/business/investor/add-investment', 'FinanceBusinessController@addInvesment')->name('business.addInvesment');
        Route::post('/finance/business/investor/save-text', 'FinanceBusinessController@updateText')->name('business.updateText');

        // Trading
        //supplier
        Route::get('/trading/supplier','TradingSupplierController@index')->name('trading.supplier.index');
        Route::get('/trading/supplier/{id}/edit','TradingSupplierController@edit')->name('trading.supplier.edit');
        Route::post('/trading/supplier/store','TradingSupplierController@storeSupplier')->name('trading.supplier.store');
        Route::post('/trading/supplier/update','TradingSupplierController@updateSupplier')->name('trading.supplier.update');
        Route::get('/trading/supplier/{id}/delete','TradingSupplierController@delete')->name('trading.supplier.delete');
        Route::post('/trading/supplier/uploadNDA','TradingSupplierController@uploadNDA')->name('trading.supplier.uploadNDA');

        //markets
        Route::get('/trading/markets','TradingMarketController@index')->name('trading.market.index');
        Route::post('/trading/store','TradingMarketController@store')->name('trading.market.store');
        Route::get('/trading/{id}/delete','TradingMarketController@delete')->name('trading.market.delete');
        Route::post('/trading/update','TradingMarketController@update')->name('trading.market.update');
        Route::post('/trading/add-js','TradingMarketController@add_js')->name('trading.market.add.js');
        Route::get('/trading/get-markets','TradingMarketController@get_markets')->name('trading.market.get.js');

        //products
        Route::get('/trading/products','TradingProductsController@index')->name('trading.products.index');
        Route::get('/trading/products/detail/{id?}','TradingProductsController@detail')->name('trading.products.detail');
        Route::post('/trading/products/add','TradingProductsController@add')->name('trading.products.add');
        Route::post('/trading/products/update','TradingProductsController@update')->name('trading.products.update');
        Route::get('/trading/products/autocomplete/{supplier?}','TradingProductsController@autocomplete')->name('trading.products.autocomplete');

        //orders
        Route::get('/trading/orders','TradingOrdersController@index')->name('trading.orders.index');
        Route::post('/trading/orders/add','TradingOrdersController@add')->name('trading.orders.add');
        Route::post('/trading/orders/final','TradingOrdersController@uploadFinal')->name('trading.orders.final');

        /*Technical Engineering*/
        //Equipment List
        Route::get('/techincal-engineering/equipment-list', 'TeEquipmentListController@index')->name('te.el.index');
        Route::get('/techincal-engineering/equipment-list/detail/{id}', 'TeEquipmentListController@detail')->name('te.el.detail');
        Route::get('/techincal-engineering/equipment-list/delete-category/{id?}', 'TeEquipmentListController@deleteCategory')->name('te.el.deleteCategory');
        Route::post('/techincal-engineering/equipment-list/add-category', 'TeEquipmentListController@addCategory')->name('te.el.addCategory');
        Route::post('/techincal-engineering/equipment-list/update-category', 'TeEquipmentListController@updateCategory')->name('te.el.updateCategory');

        Route::get('/techincal-engineering/equipment-list/delete/{id?}', 'TeEquipmentListController@delete')->name('te.el.delete');
        Route::post('/techincal-engineering/equipment-list/add', 'TeEquipmentListController@add')->name('te.el.add');
        Route::post('/techincal-engineering/equipment-list/update', 'TeEquipmentListController@update')->name('te.el.update');
        Route::get('/techincal-engineering/equipment-list/delete-file/{id?}/{type?}', 'TeEquipmentListController@deleteFile')->name('te.el.deleteFile');

        //Project Design
        Route::get('/techincal-engineering/project-design', 'TeProjectDesignController@index')->name('te.pd.index');
        Route::get('/techincal-engineering/project-design/detail/{id}', 'TeProjectDesignController@detail')->name('te.pd.detail');
        Route::get('/techincal-engineering/project-design/delete-category/{id?}', 'TeProjectDesignController@deleteCategory')->name('te.pd.deleteCategory');
        Route::post('/techincal-engineering/project-design/add-category', 'TeProjectDesignController@addCategory')->name('te.pd.addCategory');
        Route::post('/techincal-engineering/project-design/update-category', 'TeProjectDesignController@updateCategory')->name('te.pd.updateCategory');

        Route::get('/techincal-engineering/project-design/delete/{id?}', 'TeProjectDesignController@delete')->name('te.pd.delete');
        Route::post('/techincal-engineering/project-design/add', 'TeProjectDesignController@add')->name('te.pd.add');
        Route::post('/techincal-engineering/project-design/update', 'TeProjectDesignController@update')->name('te.pd.update');
        Route::get('/techincal-engineering/project-design/delete-file/{id?}/{type?}', 'TeProjectDesignController@deleteFile')->name('te.pd.deleteFile');
        Route::get('/techincal-engineering/project-design/find-items/{id?}', 'TeProjectDesignController@findItems')->name('te.pd.findItems');

        /*HIGHER AUTHORITY*/
        //PO WO Types
        Route::get('/higher-authority/po-wo-types', 'HAPoWoTypesController@index')->name('ha.powotypes.index');
        Route::get('/higher-authority/getTypes/{type?}', 'HAPoWoTypesController@getTypes')->name('ha.powotypes.getTypes');

        Route::post('/higher-authority/add-po-type', 'HAPoWoTypesController@addPoType')->name('ha.powotypes.addPoType');
        Route::post('/higher-authority/add-wo-type', 'HAPoWoTypesController@addWoType')->name('ha.powotypes.addWoType');
        Route::post('/higher-authority/updateType', 'HAPoWoTypesController@updateType')->name('ha.powotypes.updateType');
        Route::post('/higher-authority/changeType', 'HAPoWoTypesController@changeType')->name('ha.powotypes.changeType');
        Route::post('/higher-authority/delete-type/{id?}/{type?}', 'HAPoWoTypesController@deleteType')->name('ha.powotypes.deleteType');

        //PO WO Validation
        Route::get('/hihger-authority/po-wo-validation', 'HAPoWoValidationController@index')->name('ha.powoval.index');
        Route::get('/hihger-authority/po-wo-validation/delete/{id?}', 'HAPoWoValidationController@delete')->name('ha.powoval.delete');
        Route::get('/hihger-authority/po-wo-validation/find/{type?}/{kode?}', 'HAPoWoValidationController@find')->name('ha.powoval.find');

        Route::post('/hihger-authority/po-wo-validation/addCode', 'HAPoWoValidationController@addCode')->name('ha.powoval.addCode');


        //pricelist
        Route::get('/procurement/pricelist','ProcurementPriceListController@index')->name('pricelist.index');

        //salarylist
        Route::get('/dirut/salarylist','SalaryListController@index')->name('salarylist.index');


        //warehouse
        Route::get('/asset/wh','AssetWarehouseController@index')->name('wh.index');
        Route::post('/asset/wh/store','AssetWarehouseController@store')->name('wh.store');
        Route::post('/asset/wh/update','AssetWarehouseController@update')->name('wh.update');
        Route::get('/asset/wh/{id}/delete','AssetWarehouseController@delete')->name('wh.delete');

//Delivery Order
        Route::get('/general/do','GeneralDOController@index')->name('do.index');
        Route::get('/general/do/detail/{id}/{type?}','GeneralDOController@getDO')->name('do.detail');
        Route::get('/general/do/getWh','GeneralDOController@getWarehouse')->name('do.getWh');
        Route::post('/general/do/store','GeneralDOController@store')->name('do.add');
        Route::post('/general/do/edit','GeneralDOController@update')->name('do.edit');
        Route::post('/general/do/receive','GeneralDOController@updateGR')->name('do.receive');
        Route::get('/general/do/delete/{id}','GeneralDOController@deleteDO')->name('do.delete');
        Route::get('/general/dodetail/{id}/delete/{do_id}/{type?}','GeneralDOController@deleteDoDetail')->name('dodetail.delete');

        //DOWNLOADER
        Route::get('/download/{hash?}', 'DownloadController@download')->name('download');

        //Request File
        Route::get('/general/request-file', 'GeneralRequestFileController@index')->name('rf.index');
        Route::post('/general/request-file/find', 'GeneralRequestFileController@find')->name('rf.find');
        Route::post('/general/request-file/request', 'GeneralRequestFileController@request')->name('rf.request');
        Route::post('/general/request-file/approve', 'GeneralRequestFileController@approve')->name('rf.approve');
        Route::get('/general/request-file/delete/{id?}', 'GeneralRequestFileController@delete')->name('rf.delete');

        //preference
        //preference
        Route::get('/dirut/preference/{id_company}','PreferenceController@index')->name('preference');
        Route::post('/dirut/preference/store','PreferenceController@savePref')->name('pref.save');
        Route::post('/dirut/preference/storeFile','PreferenceController@upload_file')->name('pref.file.save');
        Route::get('/dirut/preference/{id}/delFile/{id_company}','PreferenceController@deleteTempFile')->name('pref.file.del');
        Route::post('/dirut/preference/store/pr','PreferenceController@store_pr')->name('pref.store_pr');
        Route::post('/dirut/preference/store/ac','PreferenceController@store_ac')->name('pref.store_ac');
        Route::post('/dirut/preference/working_environment/store','PreferenceController@store_we')->name('pref.store_we');
        Route::post('/dirut/preference/working_environment/update','PreferenceController@update_we')->name('pref.update_we');
        Route::get('/dirut/preference/working_environment/delete/{id}','PreferenceController@delete_we')->name('pref.delete_we');
        Route::get('/dirut/preference/working_environment/find/{id}','PreferenceController@find_we')->name('pref.find_we');

        //Performa Review
        Route::get('/general/performa-review', 'GeneralPerformaReviewController@index')->name('general.pr.index');
        Route::post('/general/performa-review/add', 'GeneralPerformaReviewController@add')->name('general.pr.add');
        Route::post('/general/performa-review/approve', 'GeneralPerformaReviewController@approve')->name('general.pr.approve');

        //Notif Setting
        Route::get('/other/notification', 'OtherNotificationController@index')->name('other.notif.index');
        Route::post('/other/notification/check-code', 'OtherNotificationController@check_code')->name('other.notif.check_code');
        Route::post('/other/notification/add', 'OtherNotificationController@add')->name('other.notif.add');
        Route::post('/other/notification/update', 'OtherNotificationController@update')->name('other.notif.update');
        Route::get('/other/notification/delete/{id?}', 'OtherNotificationController@delete')->name('other.notif.delete');

    });
    Route::group(['middleware' => 'guest'], function (){
        Route::get('/', [
            'uses' => 'Auth\LoginController@showLoginForm'
        ]);
    });

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/get-company/{id?}', 'Auth\LoginController@get_company')->name('home.get_company');
    Route::group(['namespace' => 'Config'], function(){
        Route::get('/success', 'InstallWizardController@success')->name('install.success');
    });
});

Route::group(['middleware' => 'isConfig', 'namespace' => 'Config'], function(){
    Route::get('/install', 'InstallWizardController@index')->name('install');
    Route::post('/install/submit', 'InstallWizardController@submit')->name('install.submit');
});






