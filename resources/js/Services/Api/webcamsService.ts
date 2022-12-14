
const getAll = async () => {
  // const response = await axios.get("applications");
  // return response.data.data;

  return fetch(`/api/webcams`)
    .then(response => response.json())
    .then(data => {
      return data.data;
    })
  ;
};

export const webcamsService = {
  getAll,
};
