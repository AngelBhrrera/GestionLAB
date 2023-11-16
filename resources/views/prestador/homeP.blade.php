@extends('layouts/prestador-layout')

@section('subcontent')
    <div class="container">
        @include('table')
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-footer" style="background-color: white">
                    <h4 class=" float-left">Horas Totales: {{$horas}}</h4>
                    <h4 class=" float-right">Horas Pendientes: {{$horasT}}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">REGISTRO DE HORAS</h2>
    </div>

     <!--BEGIN: HTML Table Data-->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Campo</label>
                    <select id="tabulator-html-filter-field" class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="date">Fecha</option>
                        <option value="enter">Entrada</option>
                        <option value="exit">Salida</option>
                        <option value="time">Tiempo</option>
                        <option value="hour">Horas</option>
                        <option value="status">Estado</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2"> </label>
                    <select id="tabulator-html-filter-type" class="form-select w-full mt-2 sm:mt-0 sm:w-auto" >
                        <option value="like" selected>es</option>
                        <option value="=">=</option>
                        <option value="<">&lt;</option>
                        <option value="<=">&lt;=</option>
                        <option value=">">></option>
                        <option value=">=">>=</option>
                        <option value="!=">!=</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Valor</label>
                    <input id="tabulator-html-filter-value" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0"  placeholder=" ">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Filtrar</button>
                    <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reiniciar</button>
                </div>
            </form>
            <div class="flex mt-5 sm:mt-0">
                <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2">
                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Imprimir
                </button>
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown">
                        <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar CSV
                                </a>
                            </li>
                            <li>
                                <a id="tabulator-export-json" href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar JSON
                                </a>
                            </li>
                            <li>
                                <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar XLSX
                                </a>
                            </li>
                            <li>
                                <a id="tabulator-export-html" href="javascript:;" class="dropdown-item">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Exportar HTML
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
             <!--END: HTML Table Data -->

        <div class="overflow-x-auto scrollbar-hidden">
            <div id="tabulator" class="mt-5 table-report table-report--tabulator tabulator" role="grid" tabulator-layout="fitColumns">
                <div class="tabulator-header" style="padding-right: 0px; margin-left: 0px;">
                    <div class="tabulator-headers" style="margin-left: 0px;">
                        <div class="tabulator-col" role="columnheader" aria-sort="none" style="min-width: 30px; width: 40px; display: none; height: 39px;" title="">
                            <div class="tabulator-col-content">
                                <div class="tabulator-col-title-holder">
                                    <div class="tabulator-col-title">&nbsp;</div>
                                </div>
                            </div>
                            <div class="tabulator-col-resize-handle"></div>
                            <div class="tabulator-col-resize-handle prev"></div>
                        </div>
                        <div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" tabulator-field="name" style="min-width: 200px; width: 200px; height: 39px;" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">FECHA</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" tabulator-field="images" style="min-width: 200px; width: 204px; display: none; height: 39px;" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">IMAGES</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" tabulator-field="remaining_stock" style="min-width: 200px; width: 204px; display: none; height: 39px;" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">REMAINING STOCK</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" tabulator-field="status" style="min-width: 200px; width: 204px; display: none; height: 39px;" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">ESTADO</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" tabulator-field="actions" style="min-width: 200px; width: 208px; display: none; height: 39px;" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">ACTIONS</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="name" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">FECHA</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="category" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">CATEGORY</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="remaining_stock" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">REMAINING STOCK</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="status" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">ESTADO</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="images" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">IMAGE 1</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="images" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">IMAGE 2</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-col tabulator-sortable" role="columnheader" aria-sort="none" style="display: none; min-width: 40px; height: 39px;" tabulator-field="images" title=""><div class="tabulator-col-content"><div class="tabulator-col-title-holder"><div class="tabulator-col-title">IMAGE 3</div><div class="tabulator-col-sorter"><div class="tabulator-arrow"></div></div></div></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div></div><div class="tabulator-frozen-rows-holder"></div></div><div class="tabulator-tableHolder" tabindex="0" style="height: 2229px;"><div class="tabulator-table" style="padding-top: 0px; padding-bottom: 0px;"><div class="tabulator-row tabulator-selectable tabulator-row-odd" role="row" style="padding-left: 0px;"><div class="tabulator-cell tabulator-row-handle" role="gridcell" style="width: 40px; text-align: center; height: 56px; display: none;" title=""><div class="tabulator-responsive-collapse-toggle open"><span class="tabulator-responsive-collapse-toggle-open">+</span><span class="tabulator-responsive-collapse-toggle-close">-</span></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 200px; display: inline-flex; align-items: center; height: 56px;" tabulator-field="name" title="">
                            <div>
                                <div class="font-medium whitespace-nowrap">Samsung Q90 QLED TV</div>
                                <div class="text-slate-500 text-xs whitespace-nowrap">Electronic</div>
                            </div>
                            <div class="tabulator-col-resize-handle"></div>
                            <div class="tabulator-col-resize-handle prev"></div>
                        </div>
                        <div class="tabulator-cell" role="gridcell" style="width: 204px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="images" title=""><div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="A" class="rounded-full" src="/build/assets/images/preview-10.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="B" class="rounded-full" src="/build/assets/images/preview-4.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="C" class="rounded-full" src="/build/assets/images/preview-5.jpg">
                            </div>
                        </div>
                        <div class="tabulator-col-resize-handle"></div>
                        <div class="tabulator-col-resize-handle prev"></div>
                    </div>
                    <div class="tabulator-cell" role="gridcell" style="width: 204px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="remaining_stock" title="">70<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 204px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="status" title=""><div class="flex items-center lg:justify-center text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Inactive
                    </div>
                    <div class="tabulator-col-resize-handle"></div>
                    <div class="tabulator-col-resize-handle prev"></div>
                </div>
                <div class="tabulator-cell" role="gridcell" style="width: 208px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="actions" title=""><div class="flex lg:justify-center items-center">
                    <a class="edit flex items-center mr-3" href="javascript:;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Edit
                    </a>
                    <a class="delete flex items-center text-danger" href="javascript:;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete
                    </a>
                </div>
                <div class="tabulator-col-resize-handle"></div>
                <div class="tabulator-col-resize-handle prev"></div>
            </div>
            <div class="tabulator-cell" role="gridcell" tabulator-field="name" style="display: none; height: 56px;" title="">Samsung Q90 QLED TV
            <div class="tabulator-col-resize-handle"></div>
            <div class="tabulator-col-resize-handle prev"></div>
        </div>
        <div class="tabulator-cell" role="gridcell" tabulator-field="category" style="display: none; height: 56px;" title="">Electronic<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="remaining_stock" style="display: none; height: 56px;" title="">70<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="status" style="display: none; height: 56px;" title="">0<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="images" style="display: none; height: 56px;" title="">preview-10.jpg,preview-4.jpg,preview-5.jpg<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="images" style="display: none; height: 56px;" title="">preview-10.jpg,preview-4.jpg,preview-5.jpg<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="images" style="display: none; height: 56px;" title="">preview-10.jpg,preview-4.jpg,preview-5.jpg<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-responsive-collapse"><table><tr><td><strong>IMAGES</strong></td><td><div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-10.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-4.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-5.jpg">
                            </div>
                        </div></td></tr><tr><td><strong>REMAINING STOCK</strong></td><td>70</td></tr><tr><td><strong>ESTADO</strong></td><td><div class="flex items-center lg:justify-center text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Inactive
                        </div></td></tr><tr><td><strong>ACCIONES</strong></td><td><div><div class="flex lg:justify-center items-center">
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Edit
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete
                            </a>
                        </div></div></td></tr></table></div></div><div class="tabulator-row tabulator-selectable tabulator-row-even" role="row" style="padding-left: 0px;"><div class="tabulator-cell tabulator-row-handle" role="gridcell" style="width: 40px; text-align: center; height: 56px; display: none;" title=""><div class="tabulator-responsive-collapse-toggle open"><span class="tabulator-responsive-collapse-toggle-open">+</span><span class="tabulator-responsive-collapse-toggle-close">-</span></div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 200px; display: inline-flex; align-items: center; height: 56px;" tabulator-field="name" title=""><div>
                            <div class="font-medium whitespace-nowrap">Nike Tanjun</div>
                            <div class="text-slate-500 text-xs whitespace-nowrap">Sport &amp; Outdoor</div>
                        </div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 204px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="images" title=""><div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-8.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-7.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-13.jpg">
                            </div>
                        </div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 204px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="remaining_stock" title="">101<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 204px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="status" title=""><div class="flex items-center lg:justify-center text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Active
                        </div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" style="width: 208px; text-align: center; display: none; align-items: center; justify-content: center; height: 56px;" tabulator-field="actions" title=""><div class="flex lg:justify-center items-center">
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path></svg> Edit
                            </a>
                            <a class="delete flex items-center text-danger" href="javascript:;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Delete
                            </a>
                        </div><div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="name" style="display: none; height: 56px;" title="">Nike Tanjun<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="category" style="display: none; height: 56px;" title="">Sport &amp; Outdoor<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="remaining_stock" style="display: none; height: 56px;" title="">101<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="status" style="display: none; height: 56px;" title="">1<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="images" style="display: none; height: 56px;" title="">preview-8.jpg,preview-7.jpg,preview-13.jpg<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="images" style="display: none; height: 56px;" title="">preview-8.jpg,preview-7.jpg,preview-13.jpg<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-cell" role="gridcell" tabulator-field="images" style="display: none; height: 56px;" title="">preview-8.jpg,preview-7.jpg,preview-13.jpg<div class="tabulator-col-resize-handle"></div><div class="tabulator-col-resize-handle prev"></div></div><div class="tabulator-responsive-collapse"><table><tr><td><strong>IMAGES</strong></td><td><div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-8.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-7.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Rocketman - HTML Admin Template" class="rounded-full" src="/build/assets/images/preview-13.jpg">
                            </div>
                       
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div></div></div></div>


                <div class="tabulator-footer">
                    <span class="tabulator-paginator">
                        <label>Page Size</label>
                        <select class="tabulator-page-size" aria-label="Page Size" title="Page Size">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                        <button class="tabulator-page" type="button" role="button" aria-label="First Page" title="First Page" data-page="first" disabled="">First</button>
                        <button class="tabulator-page" type="button" role="button" aria-label="Prev Page" title="Prev Page" data-page="prev" disabled="">Prev</button>
                        <span class="tabulator-pages">
                            <button class="tabulator-page active" type="button" role="button" aria-label="Show Page 1" title="Show Page 1" data-page="1">1</button>
                            <button class="tabulator-page" type="button" role="button" aria-label="Show Page 2" title="Show Page 2" data-page="2">2</button>
                        </span>
                        <button class="tabulator-page" type="button" role="button" aria-label="Next Page" title="Next Page" data-page="next">Next</button>
                        <button class="tabulator-page" type="button" role="button" aria-label="Last Page" title="Last Page" data-page="last">Last</button>
                    </span>
                </div>


            </div>
        </div>
    </div>

@endsection
