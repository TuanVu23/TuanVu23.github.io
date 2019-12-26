//////////////////////////////////////////////////////////////
//                                                          //
//            HƯỚNG DẪN SỬ DỤNG ỨNG DỤNG MOVIE PRO          //
//                                                          //
//////////////////////////////////////////////////////////////

I. Yêu cầu
 1) Hệ điều hành: Windows 10
 2) Cài đặt XAMPP v3.2.2 trở lên
 3) Giải nén file movie.zip vào trong thư mục /xampp/htdocs

II. Quy trình cài đặt
 1) Thiết lập cơ sở dữ liệu: 
    - Khởi động phần mềm XAMPP Control Panel
    - Start Apache và MySQL
    - Truy cập phpMyAdmin theo đường dẫn: http://localhost/phpmyadmin/
    - Tạo 1 database mới với tên 'test' và import file .sql sau (trong thư mục đã giải nén): /movie/crawler/database/test.sql
 2) Khởi chạy ứng dụng:
    - Truy cập địa chỉ http://localhost/movie/public/index trong trình duyệt web bất kỳ
    - Sử dụng các chức năng ứng dụng cung cấp
    - Tài khoản để truy cập trang quản lý của admin: 
	+ TK: admin@gmail.com
	+ MK: 123321
 3) Cập nhật dữ liệu tự động:
    - Mở ứng dụng Task Scheduler của Windows
    - Import lần lượt 4 task trong thư mục: /movie/crawler/schedule
    - Sửa lại đường dẫn tới file .bat (thuộc thư mục /movie/crawler/cmd) tương ứng với từng task vừa import trong mục Actions 