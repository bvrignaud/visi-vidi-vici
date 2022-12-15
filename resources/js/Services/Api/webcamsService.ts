
const getAll = async (params: any = {}) => {
  return fetch(`/api/webcams?` + new URLSearchParams(params).toString())
    .then(response => response.json())
    .then(data => {
      return data.data;
    })
  ;
};

export const webcamsService = {
  getAll,
};
