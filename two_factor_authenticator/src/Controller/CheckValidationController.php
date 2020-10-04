<?php

namespace App\Controller;

use App\Authenticator\Application\CheckVerificationQuery;
use App\Authenticator\Application\ExpiredCodeException;
use App\Authenticator\Application\RetrieveCodeQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class  CheckValidationController extends BaseController
{
    /**
     * @Route("/verifications/{verificationId}", name="api_check_verification",  methods={"POST"})
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function handle(Request $request, string $verificationId)
    {
        try  {
            $data = json_decode(
                $request->getContent(),
                true
            );

            $query = new CheckVerificationQuery($verificationId, $data['code']);

            $this->bus->handle($query);

            return new JsonResponse(true, 200);

        } catch (ExpiredCodeException $e) {
            return new JsonResponse(false, 404);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }


    }
}
