<?php
namespace App\Http\Controllers;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Swagger\Annotations as SWG;
/**
 * @SWG\Swagger(
 *   basePath="/$API_PREFIX$/$API_VERSION$",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller {
	public function sendResponse($result, $message): \Illuminate\Http\JsonResponse{
		return Response::json(ResponseUtil::makeResponse($message, $result));
	}
	public function sendError($error, $code = 404): \Illuminate\Http\JsonResponse{
		return Response::json(ResponseUtil::makeError($error), $code);
	}
	public function sendSuccess($message): \Illuminate\Http\JsonResponse{
		return Response::json([
			                      'success' => true,
			                      'message' => $message,
		                      ], 200);
	}
}
