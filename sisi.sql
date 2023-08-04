INSERT INTO `users` (`id`, `nama_user`, `username`, `password`, `email`, `no_hp`, `wa`, `pin`, `status_user`, `delete_mark`, `create_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'Diwa Runa', 'diwagg098', '$2y$10$IN7wSOD7K8ABU6EiBVk6legrv4YlsUIFR4hahE37AADZ.LBoxLyQi', 'diwagg098@gmail.com', '083130857262', '93729372937', '1313', 'active', 0, NULL, ' ', NULL, NULL),
(2, 'superadmin', 'superadmin', '$2y$10$iZSWn1GjmQbSMJBoQhdCn.w5tdO2glE6Box6jNLdxzBeoNtpjgzqa', 'superadmin@mail.com', '08323981932', '08127319379', '1313', 'active', 0, 'Diwa Runa', NULL, NULL, NULL);

INSERT INTO `karyawan` (`id`, `user_id`, `jabatan`, `join_date`, `gaji`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Backend', '2023-08-04 18:39:34', 100000, 'tetap', NULL, NULL),
(2, 2, 'CEO', '2023-08-04 00:00:00', 200, 'tetap', '2023-08-04 16:50:00', '2023-08-04 16:50:00');

INSERT INTO `menu_levels` (`id`, `level`) VALUES
(1, 'user'),
(2, 'menu'),
(3, 'karyawan');

INSERT INTO `menu_users` (`id`, `user_id`, `menu_id`, `delete_mark`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, NULL, '2023-08-04 16:50:00', NULL),
(2, 2, 2, 0, NULL, '2023-08-04 16:50:00', NULL),
(3, 2, 3, 0, NULL, '2023-08-04 16:50:00', NULL),
(4, 2, 4, 0, NULL, '2023-08-04 16:50:00', NULL),
(5, 2, 5, 0, NULL, '2023-08-04 16:50:00', NULL),
(8, 2, 8, 0, NULL, '2023-08-04 16:50:00', NULL),
(9, 2, 9, 0, NULL, '2023-08-04 16:54:20', '2023-08-04 16:54:20'),
(10, 1, 6, 0, NULL, '2023-08-04 16:55:23', '2023-08-04 16:55:23'),
(11, 1, 7, 0, NULL, '2023-08-04 16:55:23', '2023-08-04 16:55:23'),
(12, 1, 8, 0, NULL, '2023-08-04 16:55:23', '2023-08-04 16:55:23');

INSERT INTO `menus` (`id`, `id_level`, `menu_name`, `menu_link`, `parent_id`, `create_by`, `update_by`, `delete_mark`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tambah User', 'http://127.0.0.1:8000/users/add-user', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:42:02', '2023-08-04 16:42:02'),
(2, 1, 'Daftar User', 'http://127.0.0.1:8000/users', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:42:26', '2023-08-04 16:42:26'),
(3, 2, 'Tambah Menu', 'http://127.0.0.1:8000/menu/create', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:43:07', '2023-08-04 16:43:07'),
(4, 2, 'Daftar Menu', 'http://127.0.0.1:8000/menu', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:44:09', '2023-08-04 16:44:09'),
(5, 3, 'Daftar Karyawan', 'http://127.0.0.1:8000/karyawan', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:44:41', '2023-08-04 16:44:41'),
(6, 3, 'Presensi Karyawan', 'http://127.0.0.1:8000/karyawan/presensi-karyawan', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:45:00', '2023-08-04 16:45:00'),
(7, 3, 'Gaji', 'http://127.0.0.1:8000/karyawan/gaji', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:45:16', '2023-08-04 16:45:16'),
(8, 3, 'SPPD', 'http://127.0.0.1:8000/karyawan/sppd', NULL, 'Diwa Runa', NULL, 0, '2023-08-04 16:45:36', '2023-08-04 16:45:36'),
(9, 3, 'Pengajuan Cuti', 'http://127.0.0.1:8000/cuti', NULL, 'superadmin', NULL, 0, '2023-08-04 16:53:40', '2023-08-04 16:53:40');