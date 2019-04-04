# Proiect_OM

API Design:

  @GET  action & params;
  
Actions:
# data_create
  params: id
  returns: pointer to data
  
  Creates an internal data struct to compute on it
  
# data_free
  params: pointer
  returns: 1 if success, 0 if failure
  
  Frees an internal data struct
  
# send_timeout
