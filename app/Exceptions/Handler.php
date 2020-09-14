<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        # cuando genera algun otro error llamo al metodo ApiException
        if ($request->expectsJson()) {
            return $this->ApiException($request, $exception);
        }

        abort(500, 'Ha ocurrido un error en el servidor. Intente nuevamente o contacte a un administrador');
    }

    protected function ApiException($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            $modelo =strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("No exite ninguna instancia de {$modelo} con el id expecificado", 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse('No se encontro la url expecificada ', 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('El metodo expecificado en la peticion no es valido ', 405);
        }
        if ($exception instanceof QueryException) {
            $codigo=$exception->errorInfo[1];
            if ($codigo==1451) {
                return $this->errorResponse('No se puede eliminar de forma permanente el recurso porque esta relacionado con algun otro.', 409);
            }
        }

        return $this->errorResponse('Falla inesperada. intente luego.', 500);
    }
}
