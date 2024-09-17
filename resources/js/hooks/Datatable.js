import { onMounted, onBeforeUnmount } from 'vue';
import $ from 'jquery';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-bs5';


const currentLocale = sessionStorage.getItem("local") ?? 'en';
const languageFiles = {
  ar: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json',
  nl: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Dutch.json',
  en: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/English.json',
  fr: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/French.json',
  it: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Italian.json',
  pt: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json',
  es: 'https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json', // Castilian Spanish
};

const useDataTable = ({ tableRef, columns, data = [], url = null, actionCallback, per_page=10, advanceFilter = undefined, dom = '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">' }) => {
  onMounted(() => {
    setTimeout(() => {
      let datatableObj = {
        dom: dom,
        autoWidth: false,
        columns: columns,
        language: {
          info: 'Đang hiển thị trang _PAGE_ của _PAGES_',
          infoEmpty: 'Không có hồ sơ nào',
          infoFiltered: '(filtered from _MAX_ total records)',
          lengthMenu: 'Hiển thị _MENU_ hồ sơ trên trang',
          zeroRecords: 'Xin lỗi - Không tìm thấy dữ liệu',
          paginate: {
            previous: 'Trang trước',
            next: 'Trang sau'
          }
        },
        lengthMenu: [ [10,50,100, -1], [10,50,100, "Tất cả"] ],
        initComplete: function () {
          $(tableRef.value).find('tbody').addClass('row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2')
        }
      };

      if (url) {
        datatableObj = {
          ...datatableObj,
          processing: true,
          serverSide: true,
          pageLength: per_page,
          language: {
            url: languageFiles[currentLocale] || languageFiles['en'], // Fallback language is English
          },
          ajax: {
            url: url,
            data: function(d) {
                if(typeof advanceFilter == 'function' && advanceFilter() !== undefined) {
                    d.filter = {...d.filter, ...advanceFilter()}
                }
            }
          },
        };
      }

      if (data) {
        datatableObj = {
          ...datatableObj,
          data: data,
        };
      }

      let datatable = $(tableRef.value).DataTable(datatableObj);

      if (typeof actionCallback === 'function') {
        $(datatable.table().body()).on('click', '[data-table="action"]', function () {
          actionCallback({
            id: $(this).data('id'),
            method: $(this).data('method'),
          });
        });
      }
    }, 0);
  });

  onBeforeUnmount(() => {
    if ($.fn.DataTable.isDataTable(tableRef.value)) {
      $(tableRef.value).DataTable().destroy();
    }

    $(tableRef.value).empty();
  });
};

export default useDataTable;
