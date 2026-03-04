/*+***********************************************************************************
 * The content of this file is subject to the ITS4YouProjectsChart license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
*************************************************************************************/

/**
 * a project contais tasks, resources, roles, and info about permisions
 * @param project
 */
GanttMaster.prototype.loadProjects = function (project) {
    this.beginTransaction();
    this.resources = project.resources;
    this.roles = project.roles;
    this.canWrite = project.canWrite;
    this.canWriteOnParent = project.canWriteOnParent;
    this.cannotCloseTaskIfIssueOpen = project.cannotCloseTaskIfIssueOpen;

    if (project.minEditableDate)
        this.minEditableDate = computeStart(project.minEditableDate);
    else
        this.minEditableDate = -Infinity;

    if (project.maxEditableDate)
        this.maxEditableDate = computeEnd(project.maxEditableDate);
    else
        this.maxEditableDate = Infinity;

    this.loadProjectsAsTasks(project.tasks, project.selectedRow);
    this.deletedTaskIds = [];

    //[expand]
    this.gantt.refreshGantt();

    this.endTransaction();
    const self = this;
    this.gantt.element.oneTime(200, function () {
        self.gantt.centerOnToday()
    });
};

GanttMaster.prototype.loadProjectsAsTasks = function (tasks, selectedRow) {
    const factory = new ProjectFactory();
    //reset
    this.reset();

    for (let i = 0; i < tasks.length; i++) {
        let task = tasks[i];
        if (!(task instanceof Task)) {
            let t = factory.build(task.id, task.name, task.code, task.level, task.start, task.duration, task.collapsed);

            if (undefined !== t) {
                for (let key in task) {
                    if ('end' !== key && 'start' !== key)
                        t[key] = task[key]; //copy all properties
                }
            }
            task = t;

            task.master = this; // in order to access controller from task

            this.tasks.push(task);  //append task at the end
        }
    }

    const prof = new Profiler('gm_loadTasks_addTaskLoop');
    for (let i = 0; i < this.tasks.length; i++) {
        let task = this.tasks[i];

        //add Link collection in memory
        let linkLoops = !this.updateLinks(task);

        if (linkLoops || !task.setPeriod(task.start, task.end)) {
            alert(GanttMaster.messages.GANNT_ERROR_LOADING_DATA_TASK_REMOVED + "\n" + task.name + "\n" +
                (linkLoops ? GanttMaster.messages.CIRCULAR_REFERENCE : GanttMaster.messages.ERROR_SETTING_DATES));

            //remove task from in-memory collection
            this.tasks.splice(task.getRow(), 1);
        } else {
            //append task to editor
            this.editor.addTask(task, null, true);
            //append task to gantt
            this.gantt.addTask(task);
        }
    }

    this.editor.fillEmptyLines();
    //prof.stop();

    // re-select old row if tasks is not empty
    if (this.tasks && this.tasks.length > 0) {
        selectedRow = selectedRow ? selectedRow : 0;
        this.tasks[selectedRow].rowElement.click();
    }

};

Vtiger_List_Js('ITS4YouProjectsChart_List_Js', {

    gantt: false,

    showEditColorModel: function (url, e) {
        let element = jQuery(e);
        app.helper.showProgress();
        app.request.post({url: url}).then(function (error, data) {
            if (data) {
                app.helper.hideProgress();
                let callback = function (data) {
                    ITS4YouProjectsChart_List_Js.registerEditColorPreSaveEvent(data, element);
                    let form = jQuery('#editColor');
                    let params = {
                        submitHandler: function (form) {
                            ITS4YouProjectsChart_List_Js.saveColor(jQuery(form));
                        }
                    };
                    form.vtValidate(params);
                }
                app.helper.showModal(data, {cb: callback});
            }
        });
    },

    registerEditColorPreSaveEvent: function (data, element) {
        let selectedColorField = data.find('.selectedColor');
        let color = element.data('color');

        if (color) {
            selectedColorField.val(color);
            let customParams = {
                color: color
            };
        } else {
            //if color is not present select random color
            let randomColor = '#' + (0x1000000 + (Math.random()) * 0xffffff).toString(16).substr(1, 6);
            selectedColorField.val(randomColor);
            //color picker params for add calendar view
            let customParams = {
                color: randomColor
            };
        }

        //register color picker
        let params = {
            flat: true,
            onChange: function (hsb, hex, rgb) {
                let selectedColor = '#' + hex;
                selectedColorField.val(selectedColor);
            }
        };

        if (typeof customParams != 'undefined') {
            params = jQuery.extend(params, customParams);
        }

        data.find('.colorPicker').ColorPicker(params);

        //on change of status, update color picker with the status color
        let selectElement = data.find('[name=taskstatus]');
        selectElement.on('change', function () {
            let selectedOption = selectElement.find('option:selected');
            let color = selectedOption.data('color');
            selectedColorField.val(color);
            data.find('.colorPicker').ColorPickerSetColor(color);
        });
    },

    saveColor: function (form) {
        let color = form.find('.selectedColor').val();
        let status = form.find('[name=taskstatus]').val();

        app.helper.showProgress();
        let params = {
            'module': app.getModuleName(),
            'action': 'SaveAjax',
            'mode': 'saveColor',
            'color': color,
            'status': status
        }
        app.request.post({data: params}).then(
            function (error, data) {
                app.helper.hideProgress();
                app.helper.hideModal();
                if (!error) {
                    app.helper.showSuccessNotification({message: app.vtranslate('JS_COLOR_SAVED_SUCESSFULLY')});
                    // to reload chart
                    window.location.reload();
                } else {
                    app.helper.showErrorNotification({message: error});
                }
            }
        );

    }
}, {

    detailViewRecentTicketsTabLabel: 'HelpDesk',
    detailViewRecentTasksTabLabel: 'Project Tasks',
    detailViewRecentMileStonesLabel: 'Project Milestones',

    getRecordId: function () {
        return app.getRecordId();
    },

    /**
     * Function to register event for create related record
     * in summary view widgets
     */
    registerSummaryViewContainerEvents: function (summaryViewContainer) {
        this._super(summaryViewContainer);
        this.registerStatusChangeEventForWidget();
        this.registerEventsForTasksWidget(summaryViewContainer);
    },

    /**
     * Function to get records according to ticket status
     */
    registerStatusChangeEventForWidget: function () {
        const thisInstance = this;
        jQuery('[name="ticketstatus"],[name="projectstatus"],[name="projectprogress"]').on('change', function (e) {
            let picklistName = this.name,
                statusCondition = {},
                params = {},
                currentElement = jQuery(e.currentTarget),
                summaryWidgetContainer = currentElement.closest('.summaryWidgetContainer'),
                widgetDataContainer = summaryWidgetContainer.find('.widget_contents'),
                referenceModuleName = widgetDataContainer.find('[name="relatedModule"]').val(),
                recordId = thisInstance.getRecordId(),
                module = app.getModuleName(),
                selectedStatus = currentElement.find('option:selected').val();
            if (selectedStatus.length > 0 && 'HelpDesk' === referenceModuleName) {
                let searchInfo = new Array();
                searchInfo.push('ticketstatus');
                searchInfo.push('e');
                searchInfo.push(selectedStatus);
                statusCondition['ticketstatus'] = searchInfo;
                params['whereCondition'] = JSON.stringify(statusCondition);
            } else if ('Project' === referenceModuleName && 'projectstatus' === picklistName) {
                if (selectedStatus.length > 0) {
                    let searchInfo = new Array();
                    searchInfo.push('projectstatus');
                    searchInfo.push('e');
                    searchInfo.push(selectedStatus);
                    statusCondition['projectstatus'] = searchInfo;
                    params['whereCondition'] = JSON.stringify(statusCondition);
                }
                jQuery('[name="projectprogress"]').val('').select2("val", '');
            } else if ('Project' === referenceModuleName && 'projectprogress' === picklistName) {
                if (selectedStatus.length > 0) {
                    let searchInfo = new Array();
                    searchInfo.push('projectprogress');
                    searchInfo.push('e');
                    searchInfo.push(selectedStatus);
                    statusCondition['projectprogress'] = searchInfo;
                    params['whereCondition'] = JSON.stringify(statusCondition);
                }
                jQuery('[name="projectstatus"]').val('').select2('val', '');
            }

            params['record'] = recordId;
            params['view'] = 'Detail';
            params['module'] = module;
            params['page'] = widgetDataContainer.find('[name="page"]').val();
            params['limit'] = widgetDataContainer.find('[name="pageLimit"]').val();
            params['relatedModule'] = referenceModuleName;
            params['mode'] = 'showRelatedRecords';
            app.helper.showProgress();
            app.request.post({data: params}).then(
                function (error, data) {
                    app.helper.hideProgress();
                    widgetDataContainer.html(data);
                }
            );
        })
    },

    /**
     * Function to load module summary of Projects
     */
    loadModuleSummary: function () {
        let summaryParams = {};
        summaryParams['module'] = app.getModuleName();
        summaryParams['view'] = 'Detail';
        summaryParams['mode'] = 'showModuleSummaryView';
        summaryParams['record'] = jQuery('#recordId').val();

        app.request.post({data: summaryParams}).then(
            function (error, data) {
                jQuery('.summaryView').html(data);
            }
        );
    },

    /**
     * Function to load the gantt chart
     */
    loadGanttChart: function (container) {
        let gantt;
        //load templates
        jQuery('#ganttemplates').loadTemplates();

        // here starts gantt initialization
        gantt = new GanttMaster();
        let workSpace = $('#workSpace');
        workSpace.css({height: $('#workSpace').parent().height() - 20});
        gantt.init(workSpace);

        let ret;
        ret = JSON.parse($('#projects').val());

        gantt.loadProjects(ret);
        gantt.checkpoint(); //empty the undo stack

        $(window).resize(function () {
            workSpace.trigger('resize.gantt');
        })
        jQuery('.toggleButton').click(function () {
            workSpace.trigger('resize.gantt');
        });

        ITS4YouProjectsChart_List_Js.gantt = gantt;

        // Added to make default sortorder of startdate to be ascending
        let element = jQuery('.gdfTable.fixHead').find('.gdfColHeader[data-name=startdate]');
        element.data('nextorder', 'asc');
        element.trigger('click');
    },

    loadContents: function (url, data) {
        let detailContentsHolder = this.getContentHolder(),
            thisInstance = this
        aDeferred = jQuery.Deferred();
        if (url.indexOf('index.php') < 0) {
            url = 'index.php?' + url;
        }
        let params = [];
        params.url = url;
        if (typeof data != 'undefined') {
            params.data = data;
        }
        app.helper.showProgress();
        app.request.pjax(params).then(function (error, response) {
            detailContentsHolder.html(response);
            aDeferred.resolve(response);
            app.helper.hideProgress();
            if (detailContentsHolder.find('#workSpace').length != 0) {
                thisInstance.loadGanttChart(detailContentsHolder);
            }
        });
        return aDeferred.promise();
    },

    /**
     * Function to register events for projects widget
     */
    registerEventsForTasksWidget: function (summaryViewContainer) {
        let thisInstance = this,
            tasksWidget = summaryViewContainer.find('.widgetContainer_tasks');
        tasksWidget.on('click', '.editTaskDetails', function (e) {
            let currentTarget = jQuery(e.currentTarget),
                newValue = currentTarget.text(),
                element = currentTarget.closest('ul.dropdown-menu'),
                editElement = element.closest('.dropdown'),
                oldValue = element.data('oldValue');
            if (currentTarget.hasClass('emptyOption')) {
                newValue = '';
            }
            vtUtils.hideValidationMessage(editElement);
            if (element.data('mandatory') && newValue.length <= 0) {
                let result = app.vtranslate('JS_REQUIRED_FIELD');
                vtUtils.showValidationMessage(editElement, result);
                return false;
            }
            if (oldValue != newValue) {
                let params = {
                    action: 'SaveAjax',
                    record: element.data('recordid'),
                    field: element.data('fieldname'),
                    value: newValue,
                    module: 'Project'
                };
                app.helper.showProgress();
                app.request.post({data: params}).then(
                    function (error, data) {
                        app.helper.hideProgress();
                        thisInstance.showRelatedRecords(tasksWidget);
                    }
                );
            }
        })
    },

    /**
     * Function to get the related records list
     * summary view widget
     */
    showRelatedRecords: function (summaryWidgetContainer) {
        let widgetHeaderContainer = summaryWidgetContainer.find('.widget_header'),
            widgetDataContainer = summaryWidgetContainer.find('.widget_contents'),
            referenceModuleName = widgetHeaderContainer.find('[name="relatedModule"]').val(),
            module = app.getModuleName(),
            params = {};

        if (referenceModuleName == 'Project') {
            let statusCondition = {},
                selectedStatus = jQuery('[name="projectstatus"]', widgetHeaderContainer).val();
            if ('undefined' !== typeof selectedStatus && 0 < selectedStatus.length) {
                statusCondition['vtiger_project.projectstatus'] = selectedStatus;
                params['whereCondition'] = statusCondition;
            }
            let selectedProgress = jQuery('[name="projectprogress"]', widgetHeaderContainer).val();
            if ('undefined' !== typeof selectedProgress && 0 < selectedProgress.length) {
                statusCondition['vtiger_project.projectprogress'] = selectedProgress;
                params['whereCondition'] = statusCondition;
            }
        }

        params['record'] = this.getRecordId();
        params['view'] = 'Detail';
        params['module'] = module;
        params['page'] = widgetDataContainer.find('[name="page"]').val();
        params['limit'] = widgetDataContainer.find('[name="pageLimit"]').val();
        params['relatedModule'] = referenceModuleName;
        params['mode'] = 'showRelatedRecords';

        app.helper.showProgress();
        app.request.post({data: params}).then(
            function (error, data) {
                app.heldper.hideProgress();
                widgetDataContainer.html(data);
            }
        );
    },

    registerGanttChartEvents: function (container) {
        this.registerZoomButtons(container);
        this.registerTaskEdit(container);
        this.registerRecordUpdateEvent(container);
        this.registerGanttSorting(container);
    },

    registerZoomButtons: function (container) {

        container.on('click', '.zoomIn', function (e) {
            e.preventDefault();
            jQuery('#workSpace').trigger('zoomPlus.gantt');
        });

        container.on('click', '.zoomOut', function (e) {
            e.preventDefault();
            jQuery('#workSpace').trigger('zoomMinus.gantt');
        });
    },

    registerTaskEdit: function (container) {
        const thisInstance = this;
        container.on('click', '.editTask', function (e) {
            let element = jQuery(e.currentTarget),
                params = {
                    'module': app.getModuleName(),
                    'view': 'QuickEditAjax',
                    'returnview': 'Detail',
                    'formodule': 'Project',
                    'returnmode': 'showChart',
                    'returnmodule': app.getModuleName(),
                    'returnrecord': thisInstance.getRecordId(),
                    'parentid': thisInstance.getRecordId(),
                    'record': element.data('recordid')
                }
            app.helper.showProgress();
            app.request.post({data: params}).then(
                function (error, data) {
                    app.helper.hideProgress();
                    let callBackFunction = function (data) {
                        let form = data.find('.recordEditView'),
                            params = {
                                submitHandler: function (form) {
                                    form = jQuery(form);
                                    if ('projectTaskQuickEditForm' === form.attr('id')) {
                                        app.helper.showProgress();
                                        thisInstance.SaveProject(form).then(function (err, data) {
                                            app.helper.hideProgress();
                                            if (err === null) {
                                                jQuery('.vt-notification').remove();
                                                app.helper.hideModal();
                                                // to reload chart
                                                window.location.reload();
                                            } else {
                                                app.event.trigger('post.save.failed', err);
                                            }
                                        });
                                    }
                                },
                                validationMeta: quickcreate_uimeta
                            };
                        form.vtValidate(params);
                    }
                    let modalWindowParams = {
                        cb: callBackFunction
                    }
                    app.helper.showModal(data, modalWindowParams);
                }
            );
        });
    },

    registerRecordUpdateEvent: function (container) {
        container.on('updateTaskRecord.gantt', '#workSpace', function (e, task) {
            let dateFormat = vtUtils.getMomentDateFormat(),
                startDate = moment(task.start).format(dateFormat),
                endDate = moment(task.end).format(dateFormat);
            if ((task.oldstart != '' && task.oldend != '') && (task.oldstart != startDate || task.oldend != endDate)) {
                let params = {
                    'module': app.getModuleName(),
                    'for_module': 'Project',
                    'action': 'SaveProject',
                    'record': task.recordid,
                    'startdate': startDate,
                    'enddate': endDate
                }
                app.helper.showProgress();
                app.request.post({data: params}).then(
                    function (error, data) {
                        app.helper.hideProgress();
                        if (error === null) {
                            jQuery('.vt-notification').remove();
                        } else {
                            app.event.trigger('post.save.failed', error);
                        }
                    }
                );
            }
        });
    },

    sortResults: function (arr, prop, asc) {
        const thisInstance = this;
        arr = arr.sort(function (a, b) {
            if (asc) {
                if (a[prop] === parseInt(a[prop], 10) && b[prop] === parseInt(b[prop], 10)) {
                    return a[prop] - b[prop];
                } else if (thisInstance.isDate(a[prop]) && thisInstance.isDate(b[prop])) {
                    return new Date(a[prop]).getTime() - new Date(b[prop]).getTime();
                } else {
                    return thisInstance.sortAlphabetically(a[prop], b[prop]);
                }
            } else {
                if (a[prop] === parseInt(a[prop], 10) && b[prop] === parseInt(b[prop], 10)) {
                    return b[prop] - a[prop];
                } else if (thisInstance.isDate(a[prop]) && thisInstance.isDate(b[prop])) {
                    return new Date(b[prop]).getTime() - new Date(a[prop]).getTime();
                } else {
                    return thisInstance.sortAlphabetically(b[prop], a[prop]);
                }
            }
        });

        return arr;
    },

    isDate: function (date) {
        return (new Date(date) !== 'Invalid Date' && !isNaN(new Date(date)));
    },

    sortAlphabetically: function (a, b) {
        let nameA = a.toLowerCase(),
            nameB = b.toLowerCase()
        if (nameA < nameB) {
            return -1;
        }
        if (nameA > nameB) {
            return 1;
        }

        return 0;
    },

    registerGanttSorting: function (container) {
        const thisInstance = this;
        container.on('click', '.gdfColHeader', function (e) {
            let element = jQuery(e.currentTarget),
                text = element.data('text'),
                name = element.data('name'),
                order = element.data('nextorder');
            if (name) {
                container.find('.gdfColHeader .fa.fa-chevron-down').remove();
                container.find('.gdfColHeader .fa.fa-chevron-up').remove();
                let descTemplate = '<i class="fa fa-chevron-down"></i> ' + text,
                    ascTemplate = '<i class="fa fa-chevron-up"></i>' + text;
                if (!order) {
                    order = false;
                    element.html(descTemplate);
                } else if (order == 'asc') {
                    order = true;
                    element.html(ascTemplate);
                } else if (order == 'desc') {
                    order = false;
                    element.html(descTemplate);
                }

                let data = JSON.parse($('#projects').val());
                data.tasks = thisInstance.sortResults(data.tasks, name, order);
                if (order == false) {
                    order = 'asc';
                } else {
                    order = 'desc';
                }
                element.data('nextorder', order);
                let gantt = ITS4YouProjectsChart_List_Js.gantt;
                gantt.loadProjects(data);
                gantt.checkpoint(); //empty the undo stack
            }
        });
    },

    SaveProject: function (form) {
        let aDeferred = jQuery.Deferred();
        let formData = form.serializeFormData();
        app.request.post({data: formData}).then(
            function (error, data) {
                //TODO: App Message should be shown
                aDeferred.resolve(error, data);
            },
            function (textStatus, errorThrown) {
                aDeferred.reject(textStatus, errorThrown);
            }
        );
        return aDeferred.promise();
    },

    registerEvents: function () {
        let thisInstance = this;
        this._super();
        this.registerListEssentialsToggleEvent();
        this.registerChangeAssignedUsers();
        this.registerChangeStatus();

        thisInstance.registerGanttEvents();
    },

    registerGanttEvents: function () {
        const thisInstance = this;
        let pageViewContainer = jQuery('#page');

        thisInstance.registerGanttChartEvents(pageViewContainer);
        if (0 !== pageViewContainer.find('#workSpace').length) {
            this.loadGanttChart(pageViewContainer);
        }
    },

    registerListEssentialsToggleEvent: function () {
        jQuery('.main-container').unbind().on('click', '.essentials-toggle', function (e) {
            e.stopImmediatePropagation();
            const sideBar = jQuery('.sidebar-essentials');
            sideBar.toggleClass('hide');
            jQuery('.content-area').toggleClass('full-width');
            jQuery('.content-area-chart').toggleClass('full-width');
            let params = {
                'module': 'Users',
                'action': 'IndexAjax',
                'mode': 'toggleLeftPanel',
                'showPanel': +sideBar.hasClass('hide')
            }
            app.request.post({data: params});

            window.location.reload();
        });
    },

    loadFilter: function (filterId, data) {
        const url = jQuery('.filterName[data-filter-id="' + filterId + '"]').attr('href');

        if (url) {
            window.location.href = url;
        }
    },

    handlePostLoad: function (content, data) {
        const thisInstance = this;
        content = $(content);
        content.empty();
        content.html(data);
        thisInstance.registerGanttEvents();
    },

    registerChangeAssignedUsers: function () {
        const thisInstance = this,
            sourceModuleName = jQuery('#source_module_name').val(),
            viewId = jQuery('#custom_view_id').val(),
            moduleName = app.getModuleName();

        jQuery('#assignedUserFilter').change(function () {
            app.helper.showProgress();

            const content = jQuery('.datacontent'),
                params = {
                    'module': moduleName,
                    'view': 'IndexAjax',
                    'mode': 'getListChart',
                    'sourceModule': sourceModuleName,
                    'viewname': viewId,
                    'usersFilter': jQuery(this).val(),
                    'usersStatus': jQuery('#statusFilter').val(),
                };

            app.request.post({data: params}).then(function (error, data) {
                app.helper.hideProgress();

                if (error === null) {
                    thisInstance.handlePostLoad(content, data);
                }
            });
        });
    },

    registerChangeStatus: function () {
        const thisInstance = this,
            sourceModuleName = jQuery('#source_module_name').val(),
            viewId = jQuery('#custom_view_id').val(),
            moduleName = app.getModuleName();

        jQuery('#statusFilter').change(function () {
            app.helper.showProgress();

            const content = jQuery('.datacontent'),
                params = {
                    'module': moduleName,
                    'view': 'IndexAjax',
                    'mode': 'getListChart',
                    'sourceModule': sourceModuleName,
                    'viewname': viewId,
                    'usersFilter': jQuery('#assignedUserFilter').val(),
                    'usersStatus': jQuery(this).val(),
                };

            app.request.post({data: params}).then(function (error, data) {
                app.helper.hideProgress();

                if (error === null) {
                    thisInstance.handlePostLoad(content, data);
                }
            });
        });
    },
})