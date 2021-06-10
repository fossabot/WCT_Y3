<?php

namespace App\Http\Controllers;

use App\Models\Adminshop;
use App\Models\Casepc;
use App\Models\Casepcprice;
use App\Models\Cpu;
use App\Models\Cpuprice;
use App\Models\Internalharddrive;
use App\Models\Internalharddriveprice;
use App\Models\Memory;
use App\Models\Memoryprice;
use App\Models\Monitor;
use App\Models\Monitorprice;
use App\Models\Motherboard;
use App\Models\Motherboardprice;
use App\Models\Powersupply;
use App\Models\Powersupplyprice;
use App\Models\Videocard;
use App\Models\Videocardprice;
use Illuminate\Http\Request;

class ComponentController extends Controller
{

    /**
 * @OA\Get(
 * path="/api/admin_shop/components/list",
 * summary="list components",
* security={ {"sanctum": {} }},
 * tags={"shop"},
 *  * @OA\Parameter(
*          name="component",
*          description="name of component",
*           example="cpu",
*          required=true,
*          in="query",
*      ),
 * @OA\Response(
 *    response=200,
 *    description="",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="please test it.")
 *        )
 *     )
 * )
 */

    public function list(Request $request)
    {
        //dd($request->user()->adminshopID);
        switch ($request->component) {
            case 'cpu':
                $components = Cpu::all();
                break;
            case 'casepc':
                $components = Casepc::all();
                break;
            case 'internalharddrive':
                $components = Internalharddrive::all();
                break;
            case 'memory':
                $components = Memory::all();
                break;
            case 'monitor':
                $components = Monitor::all();
                break;
            case 'motherboard':
                $components = Motherboard::all();
                break;
            case 'powersupply':
                $components = Powersupply::all();
                break;
            case 'videocard':
                $components = Videocard::all();
                break;
            default:
                return response()->json([
                    'statusCode' => 0,
                    'message' => 'not found.'
                ],404);
                break;
        }

        return response()->json([
            'statusCode' => 1,
            'message' => $components,
        ]);
    }

    /**
 * @OA\Get(
 * path="/api/admin_shop/components/index",
 * summary="index with search pagination components",
 * security={ {"sanctum": {} }},
 * tags={"shop"},
 *  * @OA\Parameter(
*          name="search",
*          description="search by name of component",
*          example="",
*          required=true,
*          in="query",
*      ),
 *  * @OA\Parameter(
*          name="component",
*          description="name of component",
*           example="cpu",
*          required=true,
*          in="query",
*      ),
 * @OA\Parameter(
*          name="current_page",
*          description="number of component",
*           example="10",
*          required=false,
*          in="query",
*      ),
 * @OA\Parameter(
*          name="page",
*          description="number of pagination",
*           example="1",
*          required=false,
*          in="query",
*      ),
 * @OA\Response(
 *    response=200,
 *    description="",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="please test it.")
 *        )
 *     )
 * )
 */

    public function index(Request $request)
    {
        $request->validate([
            'current_page' => 'numeric|min:1|max:100'
        ]);
        switch ($request->component) {
            case 'cpu':
                $components = Cpu::where(Cpu::raw('CONCAT_WS(" ", brand, model)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                break;
            case 'casepc':
                $components = Casepc::where(Casepc::raw('CONCAT_WS(" ", brand, model)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                break;
            case 'internalharddrive':
                $components = Internalharddrive::where(Internalharddrive::raw('CONCAT_WS(" ", brand, model,storage_type)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                foreach($components as $key => $component)
                {
                    $components[$key]->model .= ' ' . $component->capacity/1000000000 . 'GB ' . $component->storage_type;
                }
                break;
            case 'memory':
                $components = Memory::where(Memory::raw('CONCAT_WS(" ", brand, model,module_type)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                break;
            case 'monitor':
                $components = Monitor::where(Monitor::raw('CONCAT_WS(" ", brand, model)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                break;
            case 'motherboard':
                $components = Motherboard::where(Motherboard::raw('CONCAT_WS(" ", brand, model,socket)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                break;
            case 'powersupply':
                $components = Powersupply::where(Powersupply::raw('CONCAT_WS(" ", brand, model)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                foreach($components as $key => $component)
                {
                    $components[$key]->model .= ' ' . $component->wattage . ' wattage';
                }
                break;
            case 'videocard':
                $components = Videocard::where(Videocard::raw('CONCAT_WS(" ", brand, model,chipset)'),'like','%'.$request->search.'%')->paginate($request->input('current_page',10));
                foreach($components as $key => $component)
                {
                    $components[$key]->model .= ' ' . $component->chipset . ' ' . $component->vram/1000000000 . 'GB ';
                }
                break;
            default:
                return response()->json([
                    'statusCode' => 0,
                    'message' => 'not found.'
                ],404);
                break;
        }

        return response()->json([
            'statusCode' => 1,
            'message' => $components->items(),
            'total_page' => $components->lastPage(),
        ]);
    }
}
