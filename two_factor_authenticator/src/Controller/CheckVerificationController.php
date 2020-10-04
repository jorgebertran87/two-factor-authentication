<?php

namespace App\Controller;

use App\Authenticator\Application\CheckVerificationDataValidator;
use App\Authenticator\Application\CheckVerificationQuery;
use App\Authenticator\Application\CodeNotFoundException;
use App\Authenticator\Application\ExpiredCodeException;
use App\Authenticator\Application\InvalidDataException;
use App\Authenticator\Application\QueryBus;
use App\Authenticator\Domain\InvalidAlphanumericFormatException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class  CheckVerificationController extends BaseController
{
    private CheckVerificationDataValidator $dataValidator;

    public function __construct( QueryBus $bus, CheckVerificationDataValidator $dataValidator)
    {
        $this->dataValidator = $dataValidator;

        parent::__construct($bus);
    }
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

            $this->dataValidator->validate($data);

            $query = new CheckVerificationQuery($verificationId, $data['code']);

            $this->bus->handle($query);

            return new JsonResponse(true, 200);

        } catch (ExpiredCodeException | CodeNotFoundException | InvalidAlphanumericFormatException $e ) {
            return new JsonResponse(false, 404);
        } catch (InvalidDataException $e) {
            return new JsonResponse(["error" => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }


    }
}
