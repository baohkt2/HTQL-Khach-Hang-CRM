/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger.Class('Vtiger_ListSidebar_Js',{},{

    isQuickEditMode: false,
    
    
    registerFilterSeach : function () {
        var self = this;
        var filters = jQuery('#module-filters');
        filters.find('.search-list').on('keyup',function(e){
            var element = jQuery(e.currentTarget);
            var val = element.val().toLowerCase();
            filters.find('.toggleFilterSize').removeClass('hide');
            jQuery('li.listViewFilter').each(function(){
                var filterEle = jQuery(this);
                var filterName = filterEle.find('a.filterName').html();
                var listsMenu = filterEle.closest('ul.lists-menu');
                if(typeof filterName != 'undefined') {
                    filterName = filterName.toLowerCase();
                    if(filterName.indexOf(val) === -1){
                        filterEle.addClass('filter-search-hide').removeClass('filter-search-show');    
                        if(listsMenu.find('li.listViewFilter').filter(':visible').length == 0) {
                            listsMenu.closest('.list-group').addClass('hide');
                        }
                        if(jQuery('#module-filters').find('ul.lists-menu li').filter(':visible').length == 0) {
                            jQuery('#module-filters').find('.noLists').removeClass('hide');
                        }
                    }else{
                        if(val) {
                            listsMenu.closest('.list-group').find('.toggleFilterSize').addClass('hide');
                        }
                        filterEle.removeClass('filter-search-hide').addClass('filter-search-show');
                        listsMenu.closest('.list-group').removeClass('hide');
                        jQuery('#module-filters').find('.noLists').addClass('hide');
                    }
                }
            });
        })
    },
    
	registerFilters: function() {
		var self = this;
        var filters = jQuery('.module-filters').not('.module-extensions');
        var scrollContainers = filters.find(".scrollContainer");
        // applying scroll to filters, tags & extensions
        jQuery.each(scrollContainers,function(key,scroll){
            var scroll = jQuery(scroll);
            var listcontentHeight = scroll.find(".list-menu-content").height();
            scroll.css("height",listcontentHeight);
            scroll.perfectScrollbar({});
        })
        
        this.registerFilterSeach();
        filters.on('click','.listViewFilter', function(e){
            if(self.isQuickEditMode) {
                var checkbox = jQuery('.quick-edit-check', jQuery(e.currentTarget));
                if (checkbox.length && !checkbox.is(':disabled') && !jQuery(e.target).is('.js-popover-container, .js-popover-container *, [data-toggle="popover"], [data-toggle="popover"] *')) {
                    e.preventDefault();
                    e.stopPropagation();
                    checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
                }
                return;
            }
			e.preventDefault();
            var targetElement = jQuery(e.target);
            if(targetElement.is('.dropdown-toggle') || targetElement.closest('ul').hasClass('dropdown-menu') ) return;
            var element = jQuery(e.currentTarget);
            var el = jQuery('a[data-filter-id]',element);
            self.getParentInstance().resetData();
            self.unMarkAllFilters();
            self.unMarkAllTags();
            el.closest('li').addClass('active');
            self.getParentInstance().filterClick = true;
            self.getParentInstance().loadFilter(el.data('filter-id'), {'page' : ''});
			var filtername = jQuery('a[class="filterName"]',element).text();
			jQuery('.module-action-content').find('.filter-name').html('&nbsp;&nbsp;<span class="fa fa-angle-right" aria-hidden="true"></span>').text(filtername);
        });
        
        jQuery('#createFilter').on('click',function(e){
            var element = jQuery(e.currentTarget);
            element.trigger('post.CreateFilter.click',{'url':element.data('url')});
        });

        this.registerQuickEditActions();
        
        filters.on('click','li.editFilter,li.duplicateFilter',function(e){
            var element = jQuery(e.currentTarget);
            if(typeof element.data('url') == "undefined") return;
            element.trigger('post.CreateFilter.click',{'url':element.data('url')});
        });
        
        filters.on('click','li.deleteFilter',function(e){
            var element = jQuery(e.currentTarget);
            if(typeof element.data('url') == "undefined") return;
            element.trigger('post.DeleteFilter.click',{'url':element.data('url')});
        });
        
        filters.on('click','li.toggleDefault',function(e){
            var element = jQuery(e.currentTarget);
            element.trigger('post.ToggleDefault.click',{'url':element.data('url')});
        });
        
        filters.on('post.DeletedFilter',function(e){
            var element = jQuery(e.target);
            var popoverId = element.closest('.popover').attr('id');
            var ele = jQuery('.list-group' ).find("[aria-describedby='" + popoverId + "']");
            ele.closest('.listViewFilter').remove();
            element.closest('.popover').remove();
        });
        
        filters.on('post.ToggleDefault.saved',function(e,params){
            var element = jQuery(e.target);
            var popoverId = element.closest('.popover').attr('id');
            var ele = jQuery('.list-group').find("[aria-describedby='" + popoverId + "']");
            if (params.isdefault === "1") {
                element.data('isDefault', true);
                var check = element.closest('.popover').find('.toggleDefault i').removeAttr('class').addClass('fa fa-check-square-o');
                var class1 = ele.closest('[rel="popover"]').removeAttr('toggleClass').attr('toggleClass', 'fa fa-check-square-o');
                element.closest('.popover').html($(".popover-content").html()).css("padding", "10px");
            }

            else {
                element.data('isDefault', false);
                var check = element.closest('.popover').find('.toggleDefault i').removeAttr('class').addClass('fa fa-square-o');
                var class1 = ele.closest('[rel="popover"]').removeAttr('toggleClass').attr('toggleClass', 'fa fa-square-o');
                element.closest('.popover').html($(".popover-content").html()).css("padding", "10px");
            }
        });
        
        filters.find('.toggleFilterSize').on('click',function(e){
            var currentTarget = jQuery(e.currentTarget);
            currentTarget.closest('.list-group').find('li.filterHidden').toggleClass('hide');
            if(currentTarget.closest('.list-group').find('li.filterHidden').hasClass('hide')) {
                currentTarget.html(currentTarget.data('moreText'));
            }else{
                currentTarget.html(currentTarget.data('lessText'));
            }
        })
        
        app.event.on('ListViewFilterLoaded', function(event, container, params) {
			// TODO - Update pagination...
		});
	},

    registerQuickEditActions: function() {
        var self = this;
        var sidebar = jQuery('#module-filters');
        var startButton = jQuery('#quickEditFilters');
        var cancelButton = jQuery('#cancelQuickEditFilters');
        var applyButton = jQuery('#applyQuickEditFilters');
        var clearButton = jQuery('#clearQuickFilters');

        var updateApplyState = function() {
            var selectedCount = sidebar.find('.quick-edit-check:checked').length;
            applyButton.prop('disabled', selectedCount === 0);
            clearButton.prop('disabled', selectedCount === 0);
            if (selectedCount > 0) {
                applyButton.text('Sửa (' + selectedCount + ')');
                clearButton.text('Xóa lọc nhanh (' + selectedCount + ')');
            } else {
                applyButton.text('Sửa');
                clearButton.text('Xóa lọc nhanh');
            }
        };

        var resetQuickEdit = function() {
            self.isQuickEditMode = false;
            startButton.removeClass('hide');
            cancelButton.addClass('hide');
            applyButton.addClass('hide').prop('disabled', true).text('Sửa');
            clearButton.addClass('hide').prop('disabled', true).text('Xóa lọc nhanh');
            sidebar.find('.quick-edit-check').addClass('hide').prop('checked', false);
            sidebar.find('.listViewFilter').removeClass('quick-edit-selected');
        };

        startButton.on('click', function(e) {
            e.preventDefault();
            self.isQuickEditMode = true;
            startButton.addClass('hide');
            cancelButton.removeClass('hide');
            applyButton.removeClass('hide');
            clearButton.removeClass('hide');
            sidebar.find('.quick-edit-check').removeClass('hide');
            updateApplyState();
        });

        cancelButton.on('click', function(e) {
            e.preventDefault();
            resetQuickEdit();
        });

        sidebar.on('click', '.quick-edit-check', function(e) {
            e.stopPropagation();
        });

        sidebar.on('change', '.quick-edit-check', function() {
            var checkbox = jQuery(this);
            checkbox.closest('.listViewFilter').toggleClass('quick-edit-selected', checkbox.is(':checked'));
            updateApplyState();
        });

        applyButton.on('click', function(e) {
            e.preventDefault();

            var selectedItems = [];
            sidebar.find('.quick-edit-check:checked').each(function() {
                var checkbox = jQuery(this);
                var item = checkbox.closest('.listViewFilter');
                var editUrl = item.data('edit-url');
                if (editUrl) {
                    selectedItems.push({
                        id: checkbox.val(),
                        url: editUrl
                    });
                }
            });

            if (selectedItems.length === 0) {
                app.helper.showErrorNotification({ message: 'Vui lòng chọn ít nhất 1 list có quyền chỉnh sửa' });
                return;
            }

            var firstItem = selectedItems[0];
            var selectedIds = [];
            for (var i = 0; i < selectedItems.length; i++) {
                selectedIds.push(selectedItems[i].id);
            }

            var separator = firstItem.url.indexOf('?') > -1 ? '&' : '?';
            var quickEditUrl = firstItem.url + separator + 'mass_edit=1&selected_cvids=' + encodeURIComponent(selectedIds.join(','));
            resetQuickEdit();
            jQuery(document).trigger('post.CreateFilter.click', { url: quickEditUrl });
        });

        clearButton.on('click', function(e) {
            e.preventDefault();

            var selectedIds = [];
            sidebar.find('.quick-edit-check:checked').each(function() {
                selectedIds.push(jQuery(this).val());
            });

            if (selectedIds.length === 0) {
                app.helper.showErrorNotification({ message: 'Vui lòng chọn ít nhất 1 list có quyền chỉnh sửa' });
                return;
            }

            app.helper.showConfirmationBox({
                message: 'Bạn có chắc muốn xóa Điều kiện lọc nhanh của các list đã chọn?'
            }).then(function() {
                app.helper.showProgress();
                app.request.post({
                    data: {
                        module: 'CustomView',
                        action: 'Save',
                        source_module: app.getModuleName(),
                        mass_edit: '1',
                        selected_cvids: selectedIds.join(','),
                        quickfilterlist: '[]'
                    }
                }).then(function(error) {
                    app.helper.hideProgress();
                    if (error === null) {
                        app.helper.showSuccessNotification({ message: 'Đã xóa Điều kiện lọc nhanh thành công' });
                        resetQuickEdit();
                        window.location.reload();
                    } else {
                        app.helper.showErrorNotification({ message: 'Không thể xóa Điều kiện lọc nhanh' });
                    }
                });
            });
        });
    },

    registerSidebarResize: function() {
        var sidebar = jQuery('#sidebar-essentials');
        var handle = jQuery('#sidebar-resize-handle');
        var content = jQuery('#listViewContent');
        if (!sidebar.length || !handle.length || !content.length) {
            return;
        }

        var moduleName = app.getModuleName() || 'default';
        var storageKey = 'vtiger.listSidebarWidth.' + moduleName;
        var moduleNavWidth = function() {
            return jQuery('#modnavigator').outerWidth() || 42;
        };
        var getMaxWidth = function() {
            var viewportMax = Math.floor(jQuery(window).width() * 0.6);
            return viewportMax > 420 ? viewportMax : 420;
        };

        var applyWidth = function(rawWidth) {
            var minWidth = 220;
            var maxWidth = getMaxWidth();
            var width = parseInt(rawWidth, 10);
            if (isNaN(width)) {
                width = sidebar.outerWidth() || 240;
            }
            if (width < minWidth) {
                width = minWidth;
            }
            if (width > maxWidth) {
                width = maxWidth;
            }

            var navWidth = moduleNavWidth();
            sidebar.css('width', width + 'px');
            content.css('padding-left', (navWidth + width + 1) + 'px');
            handle.css('left', (navWidth + width - 4) + 'px');
            return width;
        };

        var syncWithPanelState = function() {
            if (sidebar.hasClass('hide')) {
                handle.addClass('hide');
                content.css('padding-left', '');
                return;
            }

            handle.removeClass('hide');
            var savedWidth = parseInt(window.localStorage.getItem(storageKey), 10);
            if (isNaN(savedWidth)) {
                savedWidth = sidebar.outerWidth() || 240;
            }
            applyWidth(savedWidth);
        };

        handle.off('mousedown.sidebarResize').on('mousedown.sidebarResize', function(e) {
            if (sidebar.hasClass('hide')) {
                return;
            }

            e.preventDefault();
            var startX = e.clientX;
            var startWidth = sidebar.outerWidth();
            jQuery('body').addClass('sidebar-resizing');

            jQuery(document).on('mousemove.sidebarResize', function(moveEvent) {
                moveEvent.preventDefault();
                var delta = moveEvent.clientX - startX;
                applyWidth(startWidth + delta);
            });

            jQuery(document).one('mouseup.sidebarResize', function() {
                jQuery(document).off('mousemove.sidebarResize');
                jQuery('body').removeClass('sidebar-resizing');
                var finalWidth = sidebar.outerWidth();
                window.localStorage.setItem(storageKey, finalWidth);
                var filters = jQuery('.module-filters').not('.module-extensions');
                filters.find('.scrollContainer').perfectScrollbar('update');
            });
        });

        jQuery(window).off('resize.sidebarResize').on('resize.sidebarResize', function() {
            if (!sidebar.hasClass('hide')) {
                applyWidth(sidebar.outerWidth());
            }
        });

        app.event.on('Vtiger.Post.MenuToggle', function() {
            syncWithPanelState();
        });

        syncWithPanelState();
    },
    
    loadListView : function(viewId, params){
        this.getParentInstance().resetData();
        this.getParentInstance().loadFilter(viewId, params);
    },
    
    unMarkAllFilters : function() {
        jQuery('.listViewFilter').removeClass('active');
    },
    
    unMarkAllTags : function() {
        var container = jQuery('#listViewTagContainer');
        container.find('.tag').removeClass('active').find('i.activeToggleIcon').removeClass('fa-circle-o').addClass('fa-circle');
    },
    
    registerPopOverContent: function () {
        var element = jQuery(".list-group");
        var contentEle = jQuery('#filterActionPopoverHtml').clone();
        contentEle.find('.listmenu').removeClass('hide');
        var editEle = contentEle.find('.editFilter');
        var deleteEle = contentEle.find('.deleteFilter');
        var duplEle = contentEle.find('.duplicateFilter');
        var toggleEle = contentEle.find('.toggleDefault');

        jQuery.each(element.find('[rel="popover"]'), function (i, ele) {
            editEle.attr('data-url', jQuery(ele).data('editurl'));
            deleteEle.attr('data-url', jQuery(ele).data('deleteurl'));
            duplEle.attr('data-url', jQuery(ele).data('default'));
            toggleEle.attr('data-url', jQuery(ele).data('defaulttoggle'));
            toggleEle.attr('data-is-default', jQuery(ele).data('is-default'));
            toggleEle.attr('data-filter-id', jQuery(ele).data('filter-id'));
            contentEle.find('.toggleDefault i').attr('class', jQuery(ele).attr('toggleClass'));
            editEle.attr('data-id', jQuery(ele).data('id'));
            deleteEle.attr('data-id', jQuery(ele).data('id'));
            
            // Libertus Mod - data-isadmin also added to SideBarEssentials.tpl
            if((jQuery(ele).data('ismine') === false) && (jQuery(ele).data('isadmin') === false)) {
                contentEle.find('.editFilter').css("display", "none");
                contentEle.find('.deleteFilter').css("display","none");
            }

            if (!jQuery(ele).data('deletable')) {
                contentEle.find('.deleteFilter').remove(); // This propogates to the next iteration of the each() method; removing the entire li
            } else {
                if(contentEle.find('li').hasClass('deleteFilter') === false) {
                    contentEle.find('ul').prepend(deleteEle); // Add back if missing
                }
                contentEle.find('.deleteFilter').removeClass('disabled');
            }

            if (!jQuery(ele).data('editable')) {
                contentEle.find('.editFilter').remove(); // This propogates to the next iteration of the each() method; removing the entire li
            } else {
                if(contentEle.find('li').hasClass('editFilter') === false) {
                    contentEle.find('ul').prepend(editEle); // Add back if missing
                }
                contentEle.find('.editFilter').removeClass('disabled');
            }

            var options = {
                html: true,
                placement: 'left',
                template: '<div class="popover" style="top: 0; position:absolute; z-index:0; margin-top:5px"><div class="popover-content"></div></div>',
                content: contentEle.html(),
                container: jQuery('#module-filters'),
                sanitize : false, /* to allow button / anchor */
            };
            
            jQuery(ele).popover(options);
            
            jQuery('html').on('click', function (e) {
                var elements = jQuery('.activePopover');
                if(elements.length <= 0 ){
                    return;
                } else if ($(e.target).data('toggle') !== 'popover' && $(e.target).parents('[data-toggle="popover"]').length === 0
                        && $(e.target).parents('.popover.in').length === 0) {
                    elements.popover('hide').removeClass('rotate').removeClass("activePopover");
                }
            });
            
            jQuery('.js-popover-container').on('click', function(e){
                var currentElement = jQuery(e.currentTarget).find('[data-toggle]');
                if(jQuery('.popover').hasClass('in')) {
                    currentElement.addClass('rotate');
                    currentElement.addClass('activePopover');
                }else {
                    currentElement.removeClass('rotate');
                    currentElement.removeClass('activePopover');
                }
                if (jQuery('.popover', '#module-filters').length > 1) { 
                    var popoverId = jQuery('.popover', '#module-filters').attr('id');
                    var ele = jQuery('.list-group').find("[aria-describedby='" + popoverId + "']");
                    ele.removeClass('rotate');
                    jQuery('.popover', '#module-filters').first().popover('hide');
                }
            e.stopPropagation();
        });
        });
         
    },
    
    
    registerTagClick : function() {
        var self = this;
        var container = jQuery('#listViewTagContainer');
        container.on('click', '.tag', function(e) {
            var eventTriggerSourceElement = jQuery(e.target);
            //if edit icon is clicked then we dont have to load the tag
            if(eventTriggerSourceElement.is('.editTag')) {
                return;
            }
            var element = jQuery(e.currentTarget);
            var tagId = element.data('id');
            var viewId = container.data('viewId');
            
            self.unMarkAllFilters();
            self.unMarkAllTags();
            element.addClass('active');
            element.find('i.activeToggleIcon').removeClass('fa-circle').addClass('fa-circle-o');
            var listSearchParams = new Array();
            listSearchParams[0] = new Array();
            var tagSearchParams = new Array();
            tagSearchParams.push('tags');
            tagSearchParams.push('e');
            tagSearchParams.push(tagId);
            listSearchParams[0].push(tagSearchParams);
            var params = {};
            params.search_params = ''; 
            params.tag_params = JSON.stringify(listSearchParams);
            params.tag = tagId;
            params.page = '';
            self.loadListView(viewId, params);
        });
        
        container.on('click', '.moreTags', function(e){
            container.find('.moreListTags').removeClass('hide');
            jQuery(e.currentTarget).addClass('hide');
        });
    },
    registerEvents : function() {
        this.registerFilters();
        this.registerTagClick();
        this.registerPopOverContent();
        this.registerSidebarResize();
//        var listInstance = new Vtiger_List_Js();
//        listInstance.registerDynamicDropdownPosition("lists-menu", "list-menu-content");

        app.event.on('Vtiger.Post.MenuToggle', function() {
            if(!jQuery('.sidebar-essentials').hasClass('hide')) {
                var filters = jQuery('.module-filters').not('.module-extensions');
                var scrollContainers = filters.find(".scrollContainer");
                jQuery.each(scrollContainers,function(key,scroll){
                    var scroll = jQuery(scroll);
                    var listcontentHeight = scroll.find(".list-menu-content").height();
                    scroll.css("height",listcontentHeight);
                    scroll.perfectScrollbar('update');
                });
            }
        });
    }
});
