       <div class="modal" id="editModalpersonal1">
           <div class="modal-content">
               <div class="modal-header">
                   <h3>Edit Information</h3>
                   <span class="close" onclick="closeModal('personal',1)">&times;</span>
               </div>

               <form id="editFormpersonal1" action="{{ route('website.edit_personal', Auth::user()->id) }}" method="post">

                   <div id="alertBox_personal1" class="alert alert-danger w-100 " style="position: relative ; display: none">

                       <button onclick="closeAlert()" style="position: absolute; top: -25%; right: 0; border: none; background: none; font-size: 18px; cursor: pointer;" type="button">&times;</button>
                   </div>

                   @if(Auth::user()->image)

 <div class="form-group w-100 text-center mb-0">
                   <img src="{{ asset(Auth::user()->image) }}" class="profile-img mb-0" alt="">
 </div>
                   @endif

 <div class="form-group w-100">

                      <label>Update Image</label>
                       <input type="file" id="image" value="{{ Auth::user()->image }}" name="image" >
 </div>
                   <div class="form-group">

                       <label>First Name</label>
                       <input type="text" id="first_name" value="{{ Auth::user()->first_name }}" name="first_name" required>
                   </div>
                   <div class="form-group">
                       <label>Second Name</label>
                       <input type="text" id="second_name" value="{{ Auth::user()->second_name }}" name="second_name" required>
                   </div>
                   <div class="form-group">
                       <label>Email</label>
                       <input type="email" id="email" value="{{ Auth::user()->email }}" name="email" required>
                   </div>
                   <div class="form-group">
                       <label>Phone</label>
                       <input type="text" id="phone" value="{{ Auth::user()->phone }}" name="phone" required>
                   </div>
                   <div class="form-group">
                       <x-select name='unit_id' title="unit" value="{{ Auth::user()->unit->id }}" :array="$units">
                       </x-select>
                   </div>
                   <div class="form-group">
                       <x-select name='building_id' title="building" value="{{ Auth::user()->building->id }}" :array="$buildings"></x-select>
                   </div>

                   <button type="submit">Save Changes</button>
               </form>
           </div>
       </div>
