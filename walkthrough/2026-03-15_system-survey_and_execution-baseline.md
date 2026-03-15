# CUSC vTiger - Biên bản khảo sát tổng hợp trước triển khai

- Thời điểm ghi nhận: 2026-03-15 14:10:24 UTC
- Môi trường: Linux server, thao tác trực tiếp qua SSH
- Workspace: /var/www/html/cusc
- Trạng thái làm việc: Đã khảo sát hiện trạng code + database, chưa apply code thay đổi cho 3 issue trong phiên này

## 1) Mục tiêu và ràng buộc đã chốt

### Yêu cầu tổng thể
- Triển khai 3 issue:
- Issue 1: Tự động cập nhật số lượng học sinh (Contacts) cho Organizations (Accounts)
- Issue 2: Phát triển module Plan + thống kê follow-up
- Issue 3: Nâng cấp AdvancedReport để hỗ trợ đầy đủ lọc/logic tính toán và xuất Excel đáp ứng Issue 2

### Ràng buộc bắt buộc
- Không chạy DROP đối với DB/table/column nếu chưa có phê duyệt rõ ràng
- Chỉ commit khi test liên quan đã pass
- Tuân thủ kiến trúc vTiger (CRMEntity, VTEventHandler, Vtiger_Module, Vtiger_Relation, ...)
- Bắt buộc lưu walkthrough sau các thay đổi quan trọng

### Quyết định đã được người dùng duyệt
- 1) OK
- 2) OK
- 3) B (Định nghĩa email thành công theo trạng thái nghiệp vụ)
- 4) OK

Diễn giải quyết định:
- Issue 1: Đồng ý hướng xử lý
- Issue 2: Đồng ý tạo module Plan riêng
- Issue 3 (điểm xác nhận): dùng phương án B cho tiêu chí email thành công
- Cho phép bắt đầu triển khai

## 2) Tóm tắt khảo sát codebase

### 2.1 AdvancedReport hiện có
- Module hiện hữu tại:
- modules/AdvancedReport/views/List.php
- modules/AdvancedReport/actions/Generate.php
- modules/AdvancedReport/actions/Export.php
- modules/AdvancedReport/actions/SaveConfig.php
- modules/AdvancedReport/models/QueryBuilder.php
- modules/AdvancedReport/models/ReportEngine.php
- modules/AdvancedReport/models/ExcelExporter.php
- layouts/v7/modules/AdvancedReport/List.tpl
- layouts/v7/modules/AdvancedReport/resources/AdvancedReport.js

### 2.2 Đặc điểm logic hiện tại của AdvancedReport
- ReportEngine đã có sẵn các loại report dạng Campaign:
- campaign_contact_stats
- campaign_account_breakdown
- campaign_followup_stats
- organization_group_export
- QueryBuilder có hỗ trợ filters/group/order/aggregate cơ bản nhưng:
- where/having đang ghép điều kiện theo AND tuyến tính
- chưa có nhóm điều kiện lồng AND/OR theo cây điều kiện
- chưa có lớp expression engine hoàn chỉnh cho phép tính trường động một cách an toàn

### 2.3 Accounts/Contacts hiện trạng
- Accounts ListView đang có logic đếm contacts runtime (không lưu bền vào field)
- File: modules/Accounts/models/ListView.php
- Contacts liên kết Accounts qua trường:
- Contacts field account_id -> column accountid (vtiger_contactdetails.accountid)

### 2.4 Pattern event handler vTiger đã xác thực
- Hệ thống đang dùng đầy đủ vtiger.entity.aftersave / afterdelete / afterrestore
- Có mẫu đăng ký chuẩn bằng VTEventsManager trong module PBXManager
- Có handler mẫu xử lý nhiều event trong cùng class (EmailLookupHandler, PBXManagerHandler)

## 3) Tóm tắt khảo sát database (cusc_db)

## 3.1 Module metadata
- vtiger_tab:
- Accounts: tabid=6
- Contacts: tabid=4
- Campaigns: tabid=26
- AdvancedReport: tabid=60 (isentitytype=0)

## 3.2 Field "Số lượng học sinh" trên Accounts
- Field đã tồn tại sẵn:
- vtiger_field.fieldid = 2091
- fieldname = cf_2090
- tablename = vtiger_accountscf
- columnname = cf_2090
- fieldlabel = Số lượng học sinh
- uitype = 7, typeofdata = I~O
- presence = 2 (đang ẩn)
- Dữ liệu hiện tại:
- vtiger_accountscf.cf_2090: toàn bộ đang NULL

Kết luận:
- Không cần tạo cột/field mới cho Issue 1
- Nên tái sử dụng field có sẵn, bật hiển thị và cập nhật dữ liệu tự động

## 3.3 Bảng AdvancedReport
- Bảng vtiger_advancedreport_configs đã tồn tại
- Đang có 3 cấu hình report mặc định tương ứng nhóm report Campaign

## 3.4 Hoạt động follow-up/email trong dữ liệu
- vtiger_activity hiện có activitytype: Call, Emails, Task
- status: Completed, In Progress, Pending Input
- eventstatus: Planned
- Có các bảng email liên quan: vtiger_emaildetails, vtiger_email_track, vtiger_mailer_queue...

## 3.5 MySQL version
- 8.0.45-0ubuntu0.22.04.1

## 4) Khoảng trống chức năng đã xác định

### Issue 1
- Đã có field đếm học sinh nhưng chưa được dùng đúng mục đích:
- field đang ẩn
- chưa có cơ chế đồng bộ tự động khi Contacts thay đổi account

### Issue 2
- Chưa có module Plan (vtiger_tab chưa có Plan)
- Chưa có bảng chuyên dụng để ghi nhận lịch sử follow-up theo lần 1/2/3 chuẩn hóa

### Issue 3
- AdvancedReport đang thiên về report Campaign sẵn có
- Chưa đạt mức builder đầy đủ cho:
- filter đa điều kiện có nhóm AND/OR lồng nhau
- trường tính toán trực tiếp
- aggregation nâng cao có percentage theo ngữ cảnh
- Chưa có bộ report gắn với Plan theo yêu cầu nghiệm thu Issue 2

## 5) Định hướng triển khai đã chốt để thực hiện

### 5.1 Issue 1 (đã duyệt)
- Tái sử dụng field cf_2090 trên Accounts
- Bật hiển thị field (presence 0) theo metadata
- Viết handler cho Contacts để đồng bộ cf_2090 trên các event:
- vtiger.entity.aftersave
- vtiger.entity.afterdelete
- vtiger.entity.afterrestore
- Bổ sung backfill dữ liệu hiện có trước khi bật dùng chính thức

### 5.2 Issue 2 (đã duyệt)
- Tạo module Plan riêng theo chuẩn entity module của vTiger
- Tạo cấu trúc relation để gom Contacts + Accounts vào Plan
- Tạo bảng lịch sử follow-up chuyên biệt để thống kê chính xác theo:
- số mẫu follow-up/email thành công
- phân rã theo user phụ trách
- phân rã theo lần follow-up 1/2/3

### 5.3 Issue 3 (đã duyệt, tiêu chí email thành công chọn phương án B)
- Nâng cấp AdvancedReport backend + frontend
- Bổ sung condition tree AND/OR
- Bổ sung expression/calculation và aggregate mở rộng
- Cấu hình và xuất Excel được 3 báo cáo của Issue 2 theo module Plan

## 6) Trạng thái thực hiện đến hiện tại

- Hoàn tất khảo sát và thiết kế baseline
- Chưa viết code triển khai thực tế cho Issue 1/2/3 trong phiên này
- Chưa chạy test case triển khai (vì chưa có thay đổi code mới)
- Đã tạo tài liệu walkthrough này theo yêu cầu ghi nhận đầy đủ hiện trạng

## 7) Danh sách file quan trọng đã khảo sát

- modules/Accounts/models/ListView.php
- modules/Accounts/Accounts.php
- data/VTEntityDelta.php
- modules/Vtiger/handlers/EmailLookupHandler.php
- modules/PBXManager/PBXManager.php
- modules/PBXManager/PBXManagerHandler.php
- modules/AdvancedReport/models/QueryBuilder.php
- modules/AdvancedReport/models/ReportEngine.php
- modules/AdvancedReport/models/ExcelExporter.php
- modules/AdvancedReport/actions/Generate.php
- modules/AdvancedReport/actions/Export.php
- modules/AdvancedReport/actions/SaveConfig.php
- modules/AdvancedReport/views/List.php
- layouts/v7/modules/AdvancedReport/List.tpl
- layouts/v7/modules/AdvancedReport/resources/AdvancedReport.js
- migrate/advancedreport_install.php
- test/test_advanced_report.php

## 8) Ghi chú an toàn triển khai phiên tiếp theo

- Tuyệt đối không dùng DROP khi thao tác DB nếu chưa có yêu cầu/phê duyệt trực tiếp
- Ưu tiên migration idempotent, có kiểm tra tồn tại trước khi tạo
- Mọi cập nhật field metadata cần giữ tương thích layout hiện hữu
- Bắt buộc test lại các report hiện có để tránh regression

---

Tai lieu nay la moc baseline truoc khi bat dau code thay doi cho 3 issue.
