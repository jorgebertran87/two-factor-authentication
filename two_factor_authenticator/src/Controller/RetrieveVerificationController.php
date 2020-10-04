<?php

namespace App\Controller;

use App\Authenticator\Application\RetrieveVerificationQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class  RetrieveVerificationController extends BaseController
{
    /**
     * @Route("/verifications", name="api_retrieve_verification",  methods={"POST"})
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function handle(Request $request)
    {
        try  {
            $data = json_decode(
                $request->getContent(),
                true
            );

            $query = new RetrieveVerificationQuery($data['phoneNumber']);

            $verification = $this->bus->handle($query);

            return new JsonResponse(["verificationId" => (string)$verification->id(), "code" => $verification->code()->value()], 200);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }


    }
}
