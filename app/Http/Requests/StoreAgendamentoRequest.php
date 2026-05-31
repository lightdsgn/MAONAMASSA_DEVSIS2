<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCliente();
    }

    public function rules(): array
    {
        return [
            'servico_id'   => 'required|exists:servicos,id',
            'orcamento_id' => 'nullable|exists:orcamentos,id',
            'data'         => 'required|date|after_or_equal:today',
            'horario'      => 'required',
            'observacoes'  => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'servico_id.required' => 'Selecione um serviço.',
        ];
    }
}
