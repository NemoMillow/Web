// Di dalam file app/Exceptions/Handler.php
public function render($request, Throwable $exception)
{
    if (app()->environment('local')) {
        // Tampilkan detail error yang lebih jelas
        return response()->view('errors.500', [
            'exception' => $exception,
        ]);
    }

    return parent::render($request, $exception);
}