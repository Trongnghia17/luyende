<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>

<body>
    <div>
        <h1 class="text-center">DATA LADIPAGE</h1>
    </div>
    <table id="example" class="display">
        <thead>
            <tr>
                <th>STT</th>
                <th>TÊN</th>
                <th>SỐ ĐIỆN THOẠI</th>
                <th>MÔN HỌC</th>
                <th>Nguồn data</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $key=>$item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>0{{$item->phone}}</td>
                <td>
                    @if($item->math == 1)
                    Toán
                    @endif

                    @if($item->english == 1)
                    Anh
                    @endif

                    @if($item->literature == 1)
                    Văn
                    @endif
                </td>
                @if($item->type_ladipage == 1)
                <td><span style="background-color: rgba(220, 53, 69, .1);
    color: #dc3545; border-radius: 8px;" class="fw-bold px-2">hoctot.novateen.vn</span></td>
                @else
                <td><span style="    background-color: rgba(25, 135, 84, .1);
    color: #198754;border-radius: 8px;" class="fw-bold px-2">hocgioi.novateen.vn</span></td>
                @endif

                <td>{{$item->create_at}}</td>
            </tr>
            @endforeach

            <!-- Thêm các dòng dữ liệu khác vào đây -->
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "Không có dữ liệu trong bảng",
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                    "infoFiltered": "(lọc từ _MAX_ mục)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                    "search": "Tìm kiếm:",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "Tiếp",
                        "previous": "Trước"
                    },
                    "aria": {
                        "sortAscending": ": sắp xếp cột tăng dần",
                        "sortDescending": ": sắp xếp cột giảm dần"
                    }
                }
            });
        });
    </script>
</body>

</html>