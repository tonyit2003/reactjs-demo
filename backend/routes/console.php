<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('make:service {name}', function ($name) {
    // Đường dẫn để tạo file Service và Service Interface
    $servicePath = app_path("Services/{$name}Service.php");
    $serviceInterfacePath = app_path("Services/Interfaces/{$name}ServiceInterface.php");

    // Kiểm tra xem file Service đã tồn tại chưa
    if (file_exists($servicePath)) {
        $this->error("Service {$name}Service already exists!");
        return;
    }

    // Kiểm tra xem file Service Interface đã tồn tại chưa
    if (file_exists($serviceInterfacePath)) {
        $this->error("Service Interface {$name}ServiceInterface already exists!");
        return;
    }

    // Nội dung template của Service
    $serviceTemplate = "<?php\n\nnamespace App\Services;\n\nclass {$name}Service implements \App\Services\Interfaces\\{$name}ServiceInterface\n{\n    // Logic của Service\n}\n";

    // Nội dung template của Service Interface
    $serviceInterfaceTemplate = "<?php\n\nnamespace App\Services\Interfaces;\n\ninterface {$name}ServiceInterface\n{\n    // Các phương thức của Service\n}\n";

    // Tạo file Service
    file_put_contents($servicePath, $serviceTemplate);

    // Tạo file Service Interface
    file_put_contents($serviceInterfacePath, $serviceInterfaceTemplate);

    // Thông báo khi tạo thành công
    $this->info("Service {$name}Service and its Interface created successfully.");
})->purpose('Create a new service class with an interface');

Artisan::command('make:repository {name}', function ($name) {
    // Đường dẫn để tạo file Repository và Repository Interface
    $repositoryPath = app_path("Repositories/{$name}Repository.php");
    $repositoryInterfacePath = app_path("Repositories/Interfaces/{$name}RepositoryInterface.php");

    // Kiểm tra xem file Repository đã tồn tại chưa
    if (file_exists($repositoryPath)) {
        $this->error("Repository {$name}Repository already exists!");
        return;
    }

    // Kiểm tra xem file Repository Interface đã tồn tại chưa
    if (file_exists($repositoryInterfacePath)) {
        $this->error("Repository Interface {$name}RepositoryInterface already exists!");
        return;
    }

    // Nội dung template của Repository
    $repositoryTemplate = "<?php\n\nnamespace App\Repositories;\n\nclass {$name}Repository implements \App\Repositories\Interfaces\\{$name}RepositoryInterface\n{\n    // Logic của Repository\n}\n";

    // Nội dung template của Repository Interface
    $repositoryInterfaceTemplate = "<?php\n\nnamespace App\Repositories\Interfaces;\n\ninterface {$name}RepositoryInterface\n{\n    // Các phương thức của Repository\n}\n";

    // Tạo file Repository
    file_put_contents($repositoryPath, $repositoryTemplate);

    // Tạo file Repository Interface
    file_put_contents($repositoryInterfacePath, $repositoryInterfaceTemplate);

    // Thông báo khi tạo thành công
    $this->info("Repository {$name}Repository and its Interface created successfully.");
})->purpose('Create a new repository class with an interface');
