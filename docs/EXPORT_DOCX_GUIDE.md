# Huong dan xuat Document for CUSC CRM sang DOCX

## Muc tieu

- Xuat file Word tu tai lieu Markdown voi dinh dang dep, co muc luc.
- Tai su dung bang 1 script cho cac lan xuat sau.

## Script chinh

- Script: `scripts/export_cusc_crm_docx.sh`
- Dau vao mac dinh: `Document for CUSC CRM.md`
- Thu muc xuat mac dinh: `docs/exports/`

## Cach dung nhanh

1. Xuat voi ten file timestamp tu dong:

   `bash scripts/export_cusc_crm_docx.sh`

2. Xuat tu file nguon tuy chon:

   `bash scripts/export_cusc_crm_docx.sh "Document for CUSC CRM.md"`

3. Xuat ra duong dan file tuy chon:

   `bash scripts/export_cusc_crm_docx.sh "Document for CUSC CRM.md" "docs/exports/CUSC_CRM_TechProfile_manual.docx"`

## Ket qua sau moi lan chay

- Tao 1 file DOCX moi theo timestamp.
- Cap nhat alias latest:

  `docs/exports/CUSC_CRM_TechProfile_latest.docx`

## Tuy chinh style Word (khuyen nghi)

Neu can style dep hon (font, heading, table style), tao reference docx:

1. Tao file reference ban dau:

   `pandoc --print-default-data-file reference.docx > docs/templates/cusc-reference.docx`

2. Mo file `docs/templates/cusc-reference.docx` bang Microsoft Word/LibreOffice va chinh style mong muon.
3. Luu de va chay lai script export.

Script se tu dong dung `docs/templates/cusc-reference.docx` neu file ton tai.

## Kiem tra loi thuong gap

- Loi `Khong tim thay pandoc`:
  - Cai dat:
    `sudo apt-get -o Dir::Etc::sourceparts='-' update && sudo apt-get -o Dir::Etc::sourceparts='-' install -y pandoc`
- Loi khong tim thay file dau vao:
  - Kiem tra duong dan file Markdown truyen vao script.
