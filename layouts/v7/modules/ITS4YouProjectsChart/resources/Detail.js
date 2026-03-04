/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Detail_Js("Project_Detail_Js", {

    gantt: false,

    showEditColorModel: function (url, e) {
        let element = jQuery(e);
        app.helper.showProgress();
        app.request.post({url: url}).then(function (error, data) {
            if (data) {
                app.helper.hideProgress();
                let callback = function (data) {
                    Project_Detail_Js.registerEditColorPreSaveEvent(data, element);
                    let form = jQuery('#editColor'),
                        params = {
                            submitHandler: function (form) {
                                Project_Detail_Js.saveColor(jQuery(form));
                            }
                        };
                    form.vtValidate(params);
                }
                app.helper.showModal(data, {cb: callback});
            }
        });
    },

    registerEditColorPreSaveEvent: function (data, element) {
        let selectedColorField = data.find('.selectedColor'),
            color = element.data('color');

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
            let selectedOption = selectElement.find('option:selected'),
                color = selectedOption.data('color');
            selectedColorField.val(color);
            data.find('.colorPicker').ColorPickerSetColor(color);
        });
    },

    saveColor: function (form) {
        let color = form.find('.selectedColor').val(),
            status = form.find('[name=taskstatus]').val();

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
                    jQuery('[data-label-key=Chart]').click();
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
        jQuery('[name="ticketstatus"],[name="projecttaskstatus"],[name="projecttaskprogress"]').on('change', function (e) {
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
            } else if ('ProjectTask' === referenceModuleName && 'projecttaskstatus' === picklistName) {
                if (selectedStatus.length > 0) {
                    let searchInfo = new Array();
                    searchInfo.push('projecttaskstatus');
                    searchInfo.push('e');
                    searchInfo.push(selectedStatus);
                    statusCondition['projecttaskstatus'] = searchInfo;
                    params['whereCondition'] = JSON.stringify(statusCondition);
                }
                jQuery('[name="projecttaskprogress"]').val('').select2("val", '');
            } else if ('ProjectTask' === referenceModuleName && 'projecttaskprogress' === picklistName) {
                if (selectedStatus.length > 0) {
                    let searchInfo = new Array();
                    searchInfo.push('projecttaskprogress');
                    searchInfo.push('e');
                    searchInfo.push(selectedStatus);
                    statusCondition['projecttaskprogress'] = searchInfo;
                    params['whereCondition'] = JSON.stringify(statusCondition);
                }
                jQuery('[name="projecttaskstatus"]').val('').select2("val", '');
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
        summaryParams['view'] = "Detail";
        summaryParams['mode'] = "showModuleSummaryView";
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
        console.log('loadGanttChart');
        let gantt;
        //load templates
        jQuery("#ganttemplates").loadTemplates();

        // here starts gantt initialization
        gantt = new GanttMaster();
        let workSpace = $("#workSpace");
        workSpace.css({height: $("#workSpace").parent().height() - 20});
        gantt.init(workSpace);

        let ret;
        ret = JSON.parse($("#projecttasks").val());

        gantt.loadProject(ret);
        gantt.checkpoint(); //empty the undo stack

        $(window).resize(function () {
            workSpace.trigger("resize.gantt");
        })
        jQuery('.toggleButton').click(function () {
            workSpace.trigger("resize.gantt");
        });

        Project_Detail_Js.gantt = gantt;

        // Added to make default sortorder of startdate to be ascending
        let element = jQuery('.gdfTable.fixHead').find('.gdfColHeader[data-name=startdate]');
        element.data('nextorder', 'asc');
        element.trigger('click');
    },

    loadContents: function (url, data) {
        let detailContentsHolder = this.getContentHolder();
        const thisInstance = this;
        let aDeferred = jQuery.Deferred();
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
            if (0 !== detailContentsHolder.find('#workSpace').length) {
                thisInstance.loadGanttChart(detailContentsHolder);
            }
        });
        return aDeferred.promise();
    },

    /**
     * Function to register events for project tasks widget
     */
    registerEventsForTasksWidget: function (summaryViewContainer) {
        const thisInstance = this;
        let tasksWidget = summaryViewContainer.find('.widgetContainer_tasks');
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
            if (oldValue !== newValue) {
                let params = {
                    action: 'SaveAjax',
                    record: element.data('recordid'),
                    field: element.data('fieldname'),
                    value: newValue,
                    module: 'ProjectTask'
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

        if ('ProjectTask' === referenceModuleName) {
            let statusCondition = {};
            let selectedStatus = jQuery('[name="projecttaskstatus"]', widgetHeaderContainer).val();
            if (typeof selectedStatus != "undefined" && selectedStatus.length > 0) {
                statusCondition['vtiger_projecttask.projecttaskstatus'] = selectedStatus;
                params['whereCondition'] = statusCondition;
            }
            let selectedProgress = jQuery('[name="projecttaskprogress"]', widgetHeaderContainer).val();
            if (typeof selectedProgress != "undefined" && selectedProgress.length > 0) {
                statusCondition['vtiger_projecttask.projecttaskprogress'] = selectedProgress;
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
                app.helper.hideProgress();
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
            jQuery("#workSpace").trigger('zoomPlus.gantt');
        });

        container.on('click', '.zoomOut', function (e) {
            e.preventDefault();
            jQuery("#workSpace").trigger('zoomMinus.gantt');
        });
    },

    registerTaskEdit: function (container) {
        const thisInstance = this;
        container.on('click', '.editTask', function (e) {
            let element = jQuery(e.currentTarget),
                params = {
                    'module': 'ProjectTask',
                    'view': 'QuickEditAjax',
                    'returnview': 'Detail',
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
                        let form = data.find('.recordEditView');
                        let params = {
                            submitHandler: function (form) {
                                form = jQuery(form);
                                if ('projectTaskQuickEditForm' === form.attr('id')) {
                                    app.helper.showProgress();
                                    thisInstance.saveTask(form).then(function (err, data) {
                                        app.helper.hideProgress();
                                        if (err === null) {
                                            jQuery('.vt-notification').remove();
                                            app.helper.hideModal();
                                            // to reload chart
                                            jQuery('[data-label-key=Chart]').click();
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
                    'module': 'ProjectTask',
                    'action': 'SaveTask',
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
        return (new Date(date) !== "Invalid Date" && !isNaN(new Date(date))) ? true : false;
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
                } else if ('asc' === order) {
                    order = true;
                    element.html(ascTemplate);
                } else if ('desc' === order) {
                    order = false;
                    element.html(descTemplate);
                }

                let data = JSON.parse($("#projecttasks").val());
                data.tasks = thisInstance.sortResults(data.tasks, name, order);
                if (order == false) {
                    order = 'asc';
                } else {
                    order = 'desc';
                }
                element.data('nextorder', order);
                let gantt = Project_Detail_Js.gantt;
                gantt.loadProject(data);
                gantt.checkpoint(); //empty the undo stack
            }
        });
    },

    saveTask: function (form) {
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
        let detailContentsHolder = this.getContentHolder();
        const thisInstance = this;
        this._super();

        detailContentsHolder.on('click', '.moreRecentMilestones', function () {
            let recentMilestonesTab = thisInstance.getTabByLabel(thisInstance.detailViewRecentMileStonesLabel);
            recentMilestonesTab.trigger('click');
        });

        detailContentsHolder.on('click', '.moreRecentTickets', function () {
            let recentTicketsTab = thisInstance.getTabByLabel(thisInstance.detailViewRecentTicketsTabLabel);
            recentTicketsTab.trigger('click');
        });

        detailContentsHolder.on('click', '.moreRecentTasks', function () {
            let recentTasksTab = thisInstance.getTabByLabel(thisInstance.detailViewRecentTasksTabLabel);
            recentTasksTab.trigger('click');
        });

        let detailViewContainer = jQuery('.detailViewContainer');
        thisInstance.registerGanttChartEvents(detailViewContainer);
        if (0 !== detailViewContainer.find('#workSpace').length) {
            this.loadGanttChart(detailViewContainer);
        }
    }
})