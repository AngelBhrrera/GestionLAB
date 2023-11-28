

<?php $__env->startSection('subhead'); ?>
    <title>Calendar - Rocketman - Tailwind HTML Admin Template</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('subcontent'); ?>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Calendar</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i class="w-4 h-4 mr-2" data-lucide="file-text"></i> Event Reports
            </button>
            <button class="btn box">
                <i class="w-4 h-4 mr-2" data-lucide="settings"></i> Settings
            </button>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Calendar Side Menu -->
        <div class="col-span-12 xl:col-span-4 2xl:col-span-3">
            <div class="box p-2 intro-y">
                <ul class="nav nav-pills" role="tablist">
                    <li id="event-list-tab" class="nav-item flex-1" role="presentation">
                        <button
                            class="nav-link w-full py-2 active"
                            data-tw-toggle="pill"
                            data-tw-target="#event-list"
                            type="button"
                            role="tab"
                            aria-controls="event-list"
                            aria-selected="true"
                        >
                            Event List
                        </button>
                    </li>
                    <li id="add-new-event-tab" class="nav-item flex-1" role="presentation">
                        <button
                            class="nav-link w-full py-2"
                            data-tw-toggle="pill"
                            data-tw-target="#add-new-event"
                            type="button"
                            role="tab"
                            aria-controls="add-new-event"
                            aria-selected="false"
                        >
                            Add New Event
                        </button>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-5 intro-y">
                <div id="event-list" class="tab-pane active" role="tabpanel" aria-labelledby="event-list-tab">
                    <div class="h-[820px] overflow-y-auto scrollbar-hidden" id="calendar-events">
                        <div class="event box p-5 cursor-pointer mt-5 first:mt-0">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                                <div class="event__title font-medium truncate">VueJs Amsterdam</div>
                                <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                            </div>
                            <div class="border-b border-t border-slate-200/60 dark:border-darkmode-400 py-5 my-5">
                                <div class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> 02 February 2022
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> <span class="event__days mr-1">2</span> Days <span class="mx-1">•</span> 09.00 AM - 04.00 PM
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="map" class="w-4 h-4 text-slate-500 mr-2"></i>  1396 Pooh Bear Lane, New Market
                                </div>
                            </div>
                            <div class="flex">
                                <button class="btn btn-outline-secondary py-1 px-2">
                                    <i class="w-4 h-4 mr-2" data-lucide="calendar"></i> Reschedule
                                </button>
                                <button class="btn btn-outline-secondary py-1 px-2 ml-auto">
                                    <i class="w-4 h-4 mr-2" data-lucide="user-x"></i> Cancel
                                </button>
                            </div>
                        </div>
                        <div class="event box p-5 cursor-pointer mt-5 first:mt-0">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                                <div class="event__title font-medium truncate">Vue Fes Japan 2022</div>
                                <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                            </div>
                            <div class="border-b border-t border-slate-200/60 dark:border-darkmode-400 py-5 my-5">
                                <div class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> 24 March 2022
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> <span class="event__days mr-1">3</span> Days <span class="mx-1">•</span> 09.00 AM - 04.00 PM
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="map" class="w-4 h-4 text-slate-500 mr-2"></i>  1396 Pooh Bear Lane, New Market
                                </div>
                            </div>
                            <div class="flex">
                                <button class="btn btn-outline-secondary py-1 px-2">
                                    <i class="w-4 h-4 mr-2" data-lucide="calendar"></i> Reschedule
                                </button>
                                <button class="btn btn-outline-secondary py-1 px-2 ml-auto">
                                    <i class="w-4 h-4 mr-2" data-lucide="user-x"></i> Cancel
                                </button>
                            </div>
                        </div>
                        <div class="event box p-5 cursor-pointer mt-5 first:mt-0">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-success rounded-full mr-3"></div>
                                <div class="event__title font-medium truncate">Laracon 2022</div>
                                <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                            </div>
                            <div class="border-b border-t border-slate-200/60 dark:border-darkmode-400 py-5 my-5">
                                <div class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> 24 March 2022
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> <span class="event__days mr-1">4</span> Days <span class="mx-1">•</span> 09.00 AM - 04.00 PM
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="map" class="w-4 h-4 text-slate-500 mr-2"></i>  1396 Pooh Bear Lane, New Market
                                </div>
                            </div>
                            <div class="flex">
                                <button class="btn btn-outline-secondary py-1 px-2">
                                    <i class="w-4 h-4 mr-2" data-lucide="calendar"></i> Reschedule
                                </button>
                                <button class="btn btn-outline-secondary py-1 px-2 ml-auto">
                                    <i class="w-4 h-4 mr-2" data-lucide="user-x"></i> Cancel
                                </button>
                            </div>
                        </div>
                        <div class="event box p-5 cursor-pointer mt-5 first:mt-0">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                                <div class="event__title font-medium truncate">VueJs Japan</div>
                                <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-auto"></i>
                            </div>
                            <div class="border-b border-t border-slate-200/60 dark:border-darkmode-400 py-5 my-5">
                                <div class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> 10 December 2022
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-500 mr-2"></i> <span class="event__days mr-1">2</span> Days <span class="mx-1">•</span> 09.00 AM - 04.00 PM
                                </div>
                                <div class="flex items-center mt-3">
                                    <i data-lucide="map" class="w-4 h-4 text-slate-500 mr-2"></i>  1396 Pooh Bear Lane, New Market
                                </div>
                            </div>
                            <div class="flex">
                                <button class="btn btn-outline-secondary py-1 px-2">
                                    <i class="w-4 h-4 mr-2" data-lucide="calendar"></i> Reschedule
                                </button>
                                <button class="btn btn-outline-secondary py-1 px-2 ml-auto">
                                    <i class="w-4 h-4 mr-2" data-lucide="user-x"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="add-new-event" class="tab-pane" role="tabpanel" aria-labelledby="add-new-event-tab">
                    <div class="box p-5">
                        <div>
                            <label for="title" class="form-label">Title</label>
                            <input id="title" type="text" class="form-control w-full" placeholder="Event title">
                        </div>
                        <div class="mt-3">
                            <label for="date" class="form-label">Date</label>
                            <input id="date" type="text" class="datepicker form-control w-full" data-single-mode="true" placeholder="Event title">
                        </div>
                        <div class="mt-3">
                            <label for="time" class="form-label">Time</label>
                            <input id="time" type="text" class="form-control w-full" placeholder="Event title">
                        </div>
                        <div class="mt-3">
                            <label for="location" class="form-label">Location</label>
                            <textarea id="location" class="form-control w-full"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary w-full mt-5">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Calendar Side Menu -->
        <!-- BEGIN: Calendar Content -->
        <div class="col-span-12 xl:col-span-8 2xl:col-span-9">
            <div class="box p-5">
                <div class="full-calendar" id="calendar"></div>
            </div>
        </div>
        <!-- END: Calendar Content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('../layouts/main-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\GestionLAB\resources\views//newUI/calendar.blade.php ENDPATH**/ ?>