<select  class="form-control" name="expandable[]" id="select-ajax" multiple>
                                                @switch($category_id)
                                                    @case(1)
                                                        @foreach ($main_list_page->products ?? [] as $product)
                                                        <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                        @endforeach
                                                        @break
                                                    @case(2)
                                                        @foreach ($main_list_page->products ?? [] as $product)
                                                        <option selected value="{{@$product->product->id}}">{{@$product->product->name}}</option>
                                                        @endforeach
                                                        @break
                                                    @case(5)
                                                        @foreach ($main_list_page->events ?? [] as $events)
                                                        <option selected value="{{@$events->event->id}}">{{@$events->event->name}}</option>
                                                        @endforeach
                                                        @break
                                                    @case(3)
                                                        @foreach ($main_list_page->companies ?? [] as $company)
                                                            @if(!empty($company->user->first_name))
                                                                <option selected value="{{@$company->user->id}}">{{@$company->user->first_name .' | '.@$company->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    @break
                                                    @case(4)
                                                        @foreach ($main_list_page->users ?? [] as $users)
                                                            @if(!empty($users->user->first_name))
                                                                <option selected value="{{@$users->user->id}}">{{@$users->user->first_name .' | '.@$users->user->email}}</option>
                                                            @endif
                                                        @endforeach
                                                    @break
                                                    @case(6)
                                                        @foreach ($main_list_page->awards ?? [] as $award)
                                                            <option selected value="{{@$award->product->id}}">{{@$award->product->name}}  ttt</option>
                                                        @endforeach
                                                    @break
													@case(7)
                                                        @foreach ($main_list_page->brand_lists ?? [] as $brands_list_row)
                                                            <option selected value="{{@$brands_list_row->brand_list->id}}">{{@$brands_list_row->brand_list->name}}  ttt</option>
                                                        @endforeach
                                                    @break
													
                                                @endswitch
                                            </select>