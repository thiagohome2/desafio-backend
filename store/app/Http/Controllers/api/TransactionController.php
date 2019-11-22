<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\CreditCard;
use App\Models\History;
use App\Models\Cart;

use Validator;

class TransactionController extends Controller
{
    private function criatecode()
    {
        $rand = mt_rand(0, 32);
        $code = md5($rand . time());
        return substr($code,0,8).'-'.substr($code,8,4).'-'.substr($code,12,4).'-'.substr($code,16,4).'-'.substr($code,20,12);
    }

    public function store(Request $request)
    {
        $objectpost = $request->post();

        if (Cart::where('cart_id', $objectpost['cart_id'])->exists()) {

            $rules = [
                'client_id' => 'required|regex:/^([A-Za-z0-9]{8})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{12})/u|size:36',
                'cart_id' => 'required|regex:/^([A-Za-z0-9]{8})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{4})[-]([A-Za-z0-9]{12})/u|size:36',
                'client_name' => 'required',
                'value_to_pay' => 'required|integer',
                'credit_card.number' => 'required',
                'credit_card.cvv' => 'required',
                'credit_card.exp_date' => 'required|date_format:m/y',
                'credit_card.card_holder_name' => 'required'
            ];
            $messages = [
                'required' => 'O :attribute é um campo requerido.',
                'integer' => 'O :attribute é um campo inteiro.',
                'date_format' => 'A data é no padrão MM/YY.',
                'regex' => 'O formato do campo :attribute é inválido no quesito padrão.',
                'size' => 'O formato do campo :attribute é inválido no quesito tamanho.'
            ];

            $validator = Validator::make($objectpost, $rules, $messages);
            if ($validator->passes()) {

                    $order_id = $this->criatecode();

                    $transaction = new Transaction ([
                        'client_id' => $objectpost['client_id'],
                        'client_name' => $objectpost['client_name'],
                        'total_to_pay' => $objectpost['value_to_pay'],
                        'credit_card' =>  '**** **** **** '.substr($objectpost['credit_card']['number'], 11, 4)
                    ]);

                    if (!$transaction->save()) {
                        return response()->json(['data' => ['message' => 'Houve um erro ao salvar transação.']], 503);
                    }

                    if (!CreditCard::where('card_number', $objectpost['credit_card']['number'])->exists()) {

                        $credicard = new CreditCard ([
                            'card_number' => $objectpost['credit_card']['number'],
                            'card_holder_name' => $objectpost['credit_card']['card_holder_name'],
                            'cvv' => $objectpost['credit_card']['cvv'],
                            'exp_date' =>  $objectpost['credit_card']['exp_date']
                        ]);

                        if (!$credicard->save()) {
                            return response()->json(['data' => ['message' => 'Houve um erro ao salvar o cartão.']], 503);
                        }

                    }

                    $history = new History ([
                        'client_id' => $objectpost['client_id'],
                        'order_id' => $order_id,
                        'card_number' => '**** **** **** '.substr($objectpost['credit_card']['number'], 11, 4),
                        'value' =>  $objectpost['value_to_pay'],
                        'date'=>  date("d/m/Y")
                    ]);

                    if (!$history->save()) {
                        return response()->json(['data' => ['message' => 'Houve um erro ao salvar o histórico.']], 503);
                    }

                    //elimina os itens do carrinho
                    Cart::where('cart_id','=', $objectpost['cart_id'])->delete();


                    return response()->json(['data' => ['message' => 'Transação salva com sucesso!']], 201);

            } else {
                return response()->json(['data' => $validator->errors()->all()], 422);
            }
        }
        return response()->json(['data' => ['message' => 'Seu carrinho está vazio!']], 400);
    }
}
